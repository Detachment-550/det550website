<?php

class Announcement extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        if( !$this->ion_auth->logged_in() )
        {
            redirect('login/view');
        }
    }

    /**
     * Sends post out via email and groupMe
     */
    function post()
    {
        if( $this->input->post('body') != null && $this->input->post('subject') != null)
        {
            $this->load->helper('form');

            $user = $this->ion_auth->user()->row();

            $announcement = new Announcement_model();
            $announcement->title = $this->input->post('title');
            $announcement->subject = $this->input->post('subject');
            $announcement->body = $this->input->post('body');
            $announcement->created_by_id = $user->id;
            $announcement->save();

            // Goes to each selected group and sends announcement as email
            if( $this->input->post('groups') !== null )
            {
                // Encrypts the email
                $this->load->library('encryption');
                foreach( $this->input->post('groups') as $group )
                {
                    $announcement_group = new Announcement_group_model();
                    $announcement_group->announcement_id = $announcement->id;
                    $announcement_group->group_id = $group;
                    $announcement_group->save();
                }
            }

            // Sends the announcement to groupMe
            $url = "https://api.groupme.com/v3/bots/post";
            $fields = [
                'bot_id'    => "b83da12e82339a292c0173442d",
                'text'      => "Title: " . $announcement->title . "
                Subject: " . $announcement->subject . "

                Link: " . site_url("announcement/page/" . $announcement->id ),
            ];
            $fields_string = http_build_query($fields);
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_POST, count($fields));
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);

            // Goes back to announcement create page
            redirect('announcement/create');
        }
        else
        {
            show_error("The post you are trying to make doesn't have a title/subject/description.");
        }
    }

    /**
     * Allows user to create an announcement.
     */
    function create()
    {
        $data['title'] = 'Make an Announcement';

        $data['announcements'] = Announcement_model::all();
        $data['groups'] = $this->ion_auth->groups()->result();

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('announcement/makepost');
        $this->load->view('templates/footer');
    }

    /**
     * Loads announcements per page.
     *
     * @param int $page The number of the page of announcements to view
     */
    function view( $page = 0 )
    {


        $data['title'] = 'Announcements';

        $config["base_url"] = site_url('announcement/view');
        $config["per_page"] = 5;
        $config["total_rows"] = Announcement_model::all()->count();
        $config["cur_tag_open"] = "<li class='page-item active'><a class='page-link'>";
        $config["cur_tag_close"] = '</a></li>';
        $config["full_tag_open"] = "<nav aria-label='navigation' class='nav'><ul class='pagination'>";
        $config["full_tag_close"] = "</ul></nav>";
        $config["attributes"] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        // TODO: Make these announcements user specific based on the announcements groups
        $data["announcements"] = Announcement_model::with('acknowledgements')->limit($config["per_page"])
            ->offset($page)->orderBy('created_at','desc')->get();
        $data["links"] = $this->pagination->create_links();
        $data['ackposts'] = Acknowledge_post_model::all();

        $this->load->view('templates/header', $data);
        $this->load->view('announcement/announcements');
        $this->load->view('templates/footer');
    }

    /**
     * @param int $page = 0
     *
     * Searches through specified announcement data and sends to user
     */
    function search($page = 0){

        $data['title'] = 'Announcements';

        $config["base_url"] = site_url('announcement/search');
        $config["per_page"] = 50;
        $config["total_rows"] = Announcement_model::all()->count();
        $config["cur_tag_open"] = "<li class='page-item active'><a class='page-link'>";
        $config["cur_tag_close"] = '</a></li>';
        $config["full_tag_open"] = "<nav aria-label='navigation' class='nav'><ul class='pagination'>";
        $config["full_tag_close"] = "</ul></nav>";
        $config["attributes"] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $search_field = $this->input->post('post_select');
        if($search_field === 'title')
        {
            $post_title = strtoupper($this->input->post('post_value'));
            $data["announcements"] = Announcement_model::with('acknowledgements')->limit($config["per_page"])
                ->where(strtoupper('title'), 'like', '%' . $post_title . '%')
                ->offset($page)->orderBy('created_at','desc')->get();
        }
        elseif($search_field === 'subject')
        {
            $post_subject = ucwords($this->input->post('post_value'));
            $data["announcements"] = Announcement_model::with('acknowledgements')->limit($config["per_page"])
                ->where('subject', 'like', '%' . $post_subject . '%')
                ->offset($page)->orderBy('created_at','desc')->get();
        }
        elseif($search_field === 'body')
        {
            $post_body = ucfirst($this->input->post('post_value'));
            $data["announcements"] = Announcement_model::with('acknowledgements')->limit($config["per_page"])
                ->where('body', 'like', '%' . $post_body . '%')
                ->offset($page)->orderBy('created_at','desc')->get();
        }
        else{
            $data["announcements"] = Announcement_model::with('acknowledgements')->limit($config["per_page"])
                ->offset($page)->orderBy('created_at','desc')->get();
        }

        $data["links"] = $this->pagination->create_links();
        $data['ackposts'] = Acknowledge_post_model::all();

        $this->load->view('templates/header', $data);
        $this->load->view('announcement/announcements');
        $this->load->view('templates/footer');

    }

    /**
     * Shows the announcement page.
     *
     * @param int $page The id of the announcement to view
     */
    function page( int $page )
    {
        $data['title'] = 'Announcements';
        $user = $this->ion_auth->user()->row();

        $data['ackposts'] = Acknowledge_post_model::all();
        $data["announcement"] = Announcement_model::with('created_by')->find($page);
        $data['users'] = $this->ion_auth->users()->row();

        if($data['announcement']->created_by_id == $user->id)
        {
            $data['mypost'] = TRUE;
        }
        else
        {
            $data['mypost'] = FALSE;
        }

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('announcement/announcement');
        $this->load->view('templates/footer');
    }

    /**
     * Loads edit announcement page.
     */
    function edit()
    {
        $data['title'] = 'Edit Announcement';
        $data['announcement'] = Announcement_model::find($this->input->post('announcement'));

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('announcement/editannouncement');
        $this->load->view('templates/footer');
    }

    /**
     * Updates announcement that was edited.
     */
    function update()
    {
        $data['title'] = 'Edit Announcement';
        $announcement = Announcement_model::find($this->input->post('announcement'));
        $announcement->title = $this->input->post('title');
        $announcement->subject = $this->input->post('subject');
        $announcement->body = $this->input->post('body');
        $announcement->save();

        redirect("announcement/page/" . $announcement->id);
    }

    /**
     * Deletes an announcement.
     */
    function remove()
    {
        if( $this->ion_auth->is_admin() )
        {
            Announcement_group_model::where('announcement_id', '=', $this->input->post('announcement'))->delete();
            Announcement_model::find( $this->input->post('announcement') )->delete();

            redirect('cadet/view');
        }
        else
        {
            show_error("You must be an admin to delete an announcement");
        }
    }


}