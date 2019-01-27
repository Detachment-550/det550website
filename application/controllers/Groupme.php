<?php

class Groupme extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        if( $this->session->userdata('login') === true )
        {
            $this->load->model('cadetgroup_model');
        }
        else
        {
            redirect('login/view');
        }
    }

    function auth()
    {
        echo $this->input->get('access_token');
    }

}
