<?php

class Cadetdirectory extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session'); 
        
        if( $this->session->userdata('login') === true )
        {
            $this->load->model('Cadet_model');
        }
        else
        {
            redirect('login/view');
        }
    } 

    /*
     * Shows all cadets based on a given major.
     */
    function major()
    {
        $data['title'] = 'Cadet Directory';
        if( strcmp("all", $this->input->post('showcadets')) == 0 )
        {
            $data['cadets'] = $this->Cadet_model->get_all_cadets();
        }
        else
        {
            $data['cadets'] = $this->Cadet_model->get_major($this->input->post('showcadets'));
        }
        $data['majors'] = $this->Cadet_model->get_all_majors();
        $data['selected'] = $this->input->post('showcadets');

        $this->load->view('templates/header', $data);
        $this->load->view('pages/directory.php');
        $this->load->view('templates/footer'); 
    }
    
    /*
     * Shows all of the cadets in the detachment.
     */
    function view()
    {
        $data['title'] = 'Cadet Directory';
        $data['cadets'] = $this->Cadet_model->get_all_cadets();
        $data['majors'] = $this->Cadet_model->get_all_majors();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/directory.php');
        $this->load->view('templates/footer'); 
    }
    
    /*
     * Shows another cadet's profile.
     */
    function profile()
    {        
        $data['title'] = 'Profile Page';
        
        // Looks for profile picture
        $files = glob("../../../images/*.{jpg,png,jpeg}", GLOB_BRACE);
        $found = false;
        foreach($files as $file)
        {
            $info = pathinfo($file);
            if($info['filename'] == $this->input->post('rin'))
            {
                $data['picture'] = $file; 
                $found = true;
            }
        }
        if(!$found)
        {
            $data['picture'] = "../../../images/default.jpeg";
        }
        
        $data['cadet'] = $this->Cadet_model->get_cadet($this->input->post('rin'));
        
        if(strpos($data['cadet']['rank'], "AS") !== false || strpos($data['cadet']['rank'], "None") !== false)
        {
            $data['heading'] = "Cadet " . $data['cadet']['lastName'];
        }
        else
        {
            $data['heading'] = $data['cadet']['rank'] . " " . $data['cadet']['lastName'];
        } 
        
        $data['myprofile'] = false;
        
        $this->load->view('templates/header', $data);
        $this->load->view('pages/profile.php');
        $this->load->view('templates/footer');   
    }
    
}
