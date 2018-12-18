<?php

class Cadetdirectory extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Cadet_model');
    } 

    function view()
    {
        $data['title'] = 'Cadet Directory';
        $data['cadets'] = $this->Cadet_model->get_all_cadets();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/directory.php');
        $this->load->view('templates/footer'); 
    }
    
}
