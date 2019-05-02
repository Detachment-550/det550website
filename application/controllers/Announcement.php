<?php
 
class Announcement extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session'); 
        
        if( $this->ion_auth->logged_in() )
        {
            $this->load->model('Announcement_model');
            $this->load->model('Acknowledge_post_model');
        }
        else
        {
            redirect('login/view');
        }
    }
    
    /*
     * Sends the announcement.
     */
    function post()
    {
        $this->load->helper('form');
        
        if( $this->input->post('body') != null && $this->input->post('subject') != null)
        {
            $user = $this->ion_auth->user()->row();

            $params = array(
                'title'     => $this->input->post('title'),
                'subject'   => $this->input->post('subject'),
                'body'      => $this->input->post('body'),
                'createdBy' => $user->id
            );

            $id = $this->Announcement_model->add_announcement( $params );

//            TODO: Make this work with ion auth groups instead
            // Goes to each selected group and sends announcement as email
            if( $this->input->post('groups') !== null )
            {
                // Encrypts the email
                $this->load->library('encryption');

                // Load email library
                $this->load->library('email');

                $this->load->model('Groupmember_model');
                $this->load->model('Batch_email_model');

                $recipients = array();
                
                foreach( $this->input->post('groups') as $group )
                {
                    $data['members'] =  $this->Groupmember_model->get_all_groupmembers( $group );
                    foreach( $data['members'] as $member )
                    {
                        // Gets the cadet who needs to be sent an email
                        $cadet = $this->Cadet_model->get_cadet( $member['rin'] );
                        $email = $this->Batch_email_model->email_exists($cadet['rin']);

                        $message = "<h2 style='text-align:center;'>" . $this->input->post('title') . "</h2><p>" .
                            "<strong>Subject:</strong> " . $this->input->post('subject') . "</p><p>&nbsp;</p><p>&nbsp;</p>"
                            . $this->input->post('body') . "<br><hr><br>";

                        if($email !== NULL)
                        {
                            // Creates an email to be send
                            $params = array(
                                'message'       => $email['message'] . $message,
                            );

                            $this->Batch_email_model->update_batchemail($email['uid'], $params);
                        }
                        else
                        {
                            // Creates an email to be send
                            $params = array(
                                'day'           => date("Y-m-d"),
                                'to'            => $cadet['primaryEmail'],
                                'from'          => "afrotcdet550@gmail.com",
                                'subject'       => 'Wing Email',
                                'message'       => "<h1 style='text-align:center;'>Daily Announcements</h1>" .$message,
                                'title'         => 'Wing Announcements',
                                'cadet'         => $member['rin'],
                            );

                            $this->Batch_email_model->add_batchemail($params);
                        }
                    }
                }

            }

//            // Sends the announcement to groupMe
//            $url = "https://api.groupme.com/v3/bots/post";
//            $fields = [
//                'bot_id'    => "b83da12e82339a292c0173442d",
//                'text'      => "Title: " . $this->input->post('title') . "
//                Subject: " . $this->input->post('subject') . "
//
//                Link: " . site_url("announcement/page/" . $id ),
//            ];
//            $fields_string = http_build_query($fields);
//            $ch = curl_init();
//            curl_setopt($ch,CURLOPT_URL, $url);
//            curl_setopt($ch,CURLOPT_POST, count($fields));
//            curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
//            curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
//            curl_exec($ch);

            // Goes back to announcement create page
            redirect('announcement/create');
        }
        else
        {
            show_error("The post you are trying to make doesn't have a title/subject/description.");
        }
    }
    
    /*
     * Allows a user to create an announcement.
     */
    function create()
    {
        $data['title'] = 'Make an Announcement';

        $data['announcements'] =  $this->Announcement_model->get_all_announcements();
        $data['groups'] = $this->ion_auth->groups()->result();

        // Loads the home page 
        $this->load->view('templates/header', $data);
        $this->load->view('announcement/makepost');
        $this->load->view('templates/footer');  
    }

    /*
     * Shows the annoucement page.
     */
    function view( $page = 0 )
    {
        $data['title'] = 'Announcements';
        $this->load->library("pagination");

        $config = array();
        $config["base_url"] = site_url('announcement/view');

        $config["total_rows"] = $this->Announcement_model->record_count();
        $config["per_page"] = 10;
        $config["num_tag_open"] = "<li class='page-item'>";
        $config["num_tag_close"] = "</li>";
        $config["cur_tag_open"] = "<li class='page-item active'><a class='page-link'>";
        $config["cur_tag_close"] = '</a></li>';
        $config["full_tag_open"] = "<nav aria-label='navigation' class='nav'><ul class='pagination'>";
        $config["full_tag_close"] = "</ul></nav>";
        $config["first_link"] = "First";
        $config["first_tag_open"] = "<li class='page-item'>";
        $config["first_tag_close"] = "</li>";
        $config["last_link"] = "Last";
        $config["last_tag_open"] = "<li class='page-item'>";
        $config["last_tag_close"] = "</li>";
        $config["next_link"] = "Next";
        $config["next_tag_open"] = "<li class='page-item'>";
        $config["next_tag_close"] = "</li>";
        $config["prev_link"] = "Previous";
        $config["prev_tag_open"] = "<li class='page-item'>";
        $config["prev_tag_close"] = "</li>";
        $config["attributes"] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $data["announcements"] = $this->Announcement_model->get_specific_announcements($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['users'] = $this->ion_auth->users()->result();
        $data['ackposts'] = $this->Acknowledge_post_model->get_all_acknowledge_posts();

        // Loads the home page 
        $this->load->view('templates/header', $data);
        $this->load->view('announcement/announcements');
        $this->load->view('templates/footer');   
    }

    /*
  * Shows the annoucement page.
  */
    function page( $page )
    {
        $data['title'] = 'Announcements';

        $data['ackposts'] = $this->Acknowledge_post_model->get_all_acknowledge_posts();
        $data["announcement"] = $this->Announcement_model->get_announcement($page);
        $data['cadets'] = $this->Cadet_model->get_all_cadets();
        if($data['announcement']['createdBy'] == $this->session->userdata('rin'))
        {
            $data['mypost'] = true;
        }
        else
        {
            $data['mypost'] = false;
        }

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('announcement/announcement');
        $this->load->view('templates/footer');
    }

    /*
     * Loads the edit announcement page.
     */
    function edit()
    {
        $data['title'] = 'Edit Announcement';
        $data['announcement'] = $this->Announcement_model->get_announcement($this->input->post('announcement'));

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('announcement/editannouncement');
        $this->load->view('templates/footer');
    }

    /*
     * Loads the edit announcement page.
     */
    function update()
    {
        $data['title'] = 'Edit Announcement';
        $announcement = $this->Announcement_model->get_announcement($this->input->post('announcement'));

        $params = array(
            'title'     => $this->input->post('title'),
            'subject'   => $this->input->post('subject'),
            'body'      => $this->input->post('body'),
        );

        $this->Announcement_model->update_announcement( $announcement['uid'], $params );

        redirect("announcement/page/" . $announcement['uid']);
    }
}
