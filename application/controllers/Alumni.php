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
            $this->load->model('Alumni_model');

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
