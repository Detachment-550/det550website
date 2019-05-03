<?php

class Group extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session'); 
        
        if( !$this->ion_auth->logged_in() )
        {
            redirect('login/view');
        }
    }

    /*
     * Shows the page where admins can create/edit/delete groups.
     */
    function adminview()
    {
        if( $this->ion_auth->is_admin() )
        {
            $data['title'] = "Edit Groups";

            $this->load->view('templates/header', $data);
            $this->load->view('admin/addgroup');
            $this->load->view('templates/footer');
        }
        else
        {
            show_error("You must be an admin to view this page");
        }
    }
}
