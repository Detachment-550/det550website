<?php

class Alumni extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        if(!$this->ion_auth->logged_in())
        {
	        $this->session->set_flashdata('redirect_url', current_url());
	        redirect('login/view');
        }
    }

    /**
     * Function to create an allumni account from a normal account
     */
    function create()
    {
        if( isset($_POST) && count($_POST) > 0 && $this->ion_auth->is_admin() )
        {
            $alumni = new Alumni_model();
            $alumni->rank = 'rank';
            $alumni->email = 'email';
            $alumni->first_name = 'First';
            $alumni->last_name = 'Last';
            $alumni->phone = '0000000000';
            $alumni->major = 'Major';
            $alumni->position = 'Position';

            $user = $this->ion_auth->user($this->input->post('transfer'))->row();

            $user->rank = '2nd Lieutenant';
            $alumni->rank = $user->rank;
            $alumni->email = $user->email;
            $alumni->first_name = $user->first_name;
            $alumni->last_name = $user->last_name;
            if(!$user->phone == ''){
                $alumni->phone = $user->phone;
            }
            if(!$user->major == ''){
                $alumni->major = $user->major;

            }
            if(!$user->position == ''){
                $alumni->position = $user->position;

            }
            $alumni->image = $user->image;
            $alumni->save();

            $this->ion_auth->delete_user($user->id);

            redirect('cadet/view');
        }
        else
        {
            show_error("You mus be an admin to transfer a user to alumni status. You also must provide a user
            id of the user you wish to transfer.");
        }
    }

    /**
     * Modify existing alumni
     */
    function modify()
    {
        if( $this->ion_auth->is_admin() )
        {
            $data['title'] = "Modify Alumni";
            $data['alumni'] = Alumni_model::all();

            $this->load->view('templates/header', $data);
            $this->load->view('alumni/editalumni');
            $this->load->view('templates/footer');
        }
        else
        {
            show_error("You mus be an admin to modify alumni.");
        }
    }

    /**
     * Updates an existing alumni record.
     */
    function edit()
    {
//        TODO: Add ability to edit alumni picture
        if( $this->ion_auth->is_admin() && isset($_POST) && count($_POST) > 0 )
        {
            $alumni = Alumni_model::find($this->input->post('alumni'));
            $alumni->rank = $this->input->post('rank');
            $alumni->email = $this->input->post('email');
            $alumni->first_name = $this->input->post('firstname');
            $alumni->last_name = $this->input->post('lastname');
            $alumni->phone = $this->input->post('phone');
            $alumni->major = $this->input->post('major');
            $alumni->position = $this->input->post('position');
            $alumni->save();

            redirect('alumni/modify');
        }
        else
        {
            show_error("You mus be an admin to modify alumni. You also must provide information about the alumni to edit.");
        }
    }

    /**
     * Accessor function to get json of alumni account
     */
    function info()
    {
        if( $this->ion_auth->is_admin() && isset($_POST) && count($_POST) > 0 )
        {
            $data['alumni'] = Alumni_model::find($this->input->post('alumni'));
        }
        else
        {
            $data['error'] = "You mus be an admin to view alumni information. You also must provide an alumni_id to get this information.";
        }

        echo json_encode($data);
    }

    /**
     * Creates alumni account
     */
    function addalum()
    {
        if( $this->ion_auth->is_admin() && isset($_POST) && count($_POST) > 0 )
        {

            $alumni = new Alumni_model();
            $alumni->rank = $this->input->post('rank');
            $alumni->email = $this->input->post('email');
            $alumni->first_name = $this->input->post('firstname');
            $alumni->last_name = $this->input->post('lastname');
            $alumni->phone = $this->input->post('phone');
            $alumni->major = $this->input->post('major');
            $alumni->position = $this->input->post('position');
            $alumni->save();

            $config['upload_path']      = 'images/';
            $config['allowed_types']    = 'jpeg|jpg|png';
            $config['max_size']         = 100000;
            $config['max_width']        = 20000;
            $config['max_height']       = 20000;
            $config['file_name']        = 'alum' . $alumni->id;

            // If old profile picture exists delete it
            if(is_file('./images/' . 'alum' . $alumni->id))
            {
                unlink('./images/'. 'alum' . $alumni->id);
            }

            // Uploads image
            $this->load->library('upload', $config);
            if( !$this->upload->do_upload('image') )
            {
                $data['error'] = $this->upload->display_errors();

                $this->load->view('templates/header', $data);
                $this->load->view('alumni/editalumni');
                $this->load->view('templates/footer');
            }
            else
            {
                $alumni->image = $this->upload->data('file_name');
                $alumni->save();

                redirect('alumni/modify');
            }
        }
        else
        {
            show_error("You mus be an admin to add alumni. You also must provide information about the alumni to add.");
        }
    }

    /**
     * Deletes an alumni record.
     */
    function remove()
    {
        if( $this->ion_auth->is_admin() && isset($_POST) && count($_POST) > 0 )
        {
            Alumni_model::find($this->input->post('alumni'))->delete();
            redirect('alumni/modify');
        }
        else
        {
            show_error("You mus be an admin to delete alumni. You also must provide an alumni_id to delete an alumni record.");
        }
    }

    /**
     * Shows the directory of all of the alumni.
     */
    function view()
    {
        $data['title'] = "Alumni Directory";
        $data['alumni'] = Alumni_model::all();

        $this->load->view('templates/header', $data);
        $this->load->view('alumni/alumnidirectory');
        $this->load->view('templates/footer');
    }

}
