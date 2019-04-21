<?php

class Groupmember extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session'); 
        
        if( $this->session->userdata('login') === true )
        {
            $this->load->model('Groupmember_model');
        }
        else
        {
            redirect('login/view');
        }
    }
}
