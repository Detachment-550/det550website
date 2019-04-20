<?php

class Groupme extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        if( $this->session->userdata('login') === true )
        {
            $this->load->model('Cadet_model');
            $this->load->model('cadetgroup_model');
        }
        else
        {
            redirect('login/view');
        }
    }

    /*
     * Saves cadets groupme access token to their profile
     */
    function auth()
    {
        $params = array(
            'groupMe' => $this->input->get('access_token')
        );

        $this->Cadet_model->update_cadet($this->session->userdata('rin'),$params);

        redirect('cadet/edit');
    }

}
