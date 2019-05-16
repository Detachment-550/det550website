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

    /*
     * Transfers an account to an alumni status
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

    /*
     * Transfers an account to an alumni status
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

    /*
     * Updates an existing alumni record.
     */
    function edit()
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
                'image' => $this->input->post('image'),
            );

            $this->Alumni_model->update_alumni($this->input->post('alumni'), $params);
            redirect('alumni/modify');
        }
        else
        {
            show_error("You mus be an admin to modify alumni. You also must provide information about the alumni to edit.");
        }
    }

    /*
     * Returns json of a given alumni account
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

    /*
     * Updates an existing alumni record.
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
                'image' => $this->input->post('image'),
            );

            $this->Alumni_model->add_alumni($params);
            redirect('alumni/modify');
        }
        else
        {
            show_error("You mus be an admin to add alumni. You also must provide information about the alumni to add.");
        }
    }

    /*
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

    /*
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
