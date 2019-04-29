<?php

class Groupmember extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session'); 
        
        if( $this->ion_auth->logged_in() )
        {
            $this->load->model('Groupmember_model');
        }
        else
        {
            redirect('login/view');
        }
    }
}
