<?php

class Alumni extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        if($this->ion_auth->logged_in())
        {
            $this->load->model('Alumni_model');
        }
        else
        {
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
            $user = $this->ion_auth->user($this->input->post('transfer'))->row();

            $params = array(
                'rank' => $user->rank,
                'email' => $user->email,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'phone' => $user->phone,
                'major' => $user->major,
                'position' => $user->position,
                'image' => $user->image,
            );

            $this->Alumni_model->add_alumni($params);

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
            $data['alumni'] = $this->Alumni_model->get_all_alumni();

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
            $params = array(
                'rank' => $this->input->post('rank'),
                'email' => $this->input->post('email'),
                'first_name' => $this->input->post('firstname'),
                'last_name' => $this->input->post('lastname'),
                'phone' => $this->input->post('phone'),
                'major' => $this->input->post('major'),
                'position' => $this->input->post('position'),
            );

            $this->Alumni_model->update_alumni($this->input->post('alumni'), $params);
            redirect('alumni/modify');
        }
        else
        {
            show_error("You mus be an admin to modify alumni. You also must provide information about the alumni to edit.");
        }
    }

    /**
     * Accessor function to get json of alumni account
     *
     * @return string - json encryption of a given alumni account
     */
    function info()
    {
        if( $this->ion_auth->is_admin() && isset($_POST) && count($_POST) > 0 )
        {
            $data['alumni'] = $this->Alumni_model->get_alumni($this->input->post('alumni'));
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
            $params = array(
                'rank' => $this->input->post('rank'),
                'email' => $this->input->post('email'),
                'first_name' => $this->input->post('firstname'),
                'last_name' => $this->input->post('lastname'),
                'phone' => $this->input->post('phone'),
                'major' => $this->input->post('major'),
                'position' => $this->input->post('position'),
            );

            $id = $this->Alumni_model->add_alumni($params);

            $config['upload_path']      = 'images/';
            $config['allowed_types']    = 'jpeg|jpg|png';
            $config['max_size']         = 100000;
            $config['max_width']        = 20000;
            $config['max_height']       = 20000;
            $config['file_name']        = 'alum' . $id;

            // If old profile picture exists delete it
            if(is_file('./images/' . 'alum' . $id))
            {
                unlink('./images/'. 'alum' . $id);
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
                $params = array(
                    'image' => $this->upload->data('file_name'),
                );

                $this->Alumni_model->update_alumni($id, $params);

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
            $this->Alumni_model->delete_alumni($this->input->post('alumni'));
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
        $data['alumni'] = $this->Alumni_model->get_all_alumni();

        $this->load->view('templates/header', $data);
        $this->load->view('alumni/alumnidirectory');
        $this->load->view('templates/footer');
    }

}
