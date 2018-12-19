<?php
 
class Email extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('cadetgroup_model');
    } 

    /*
     * Shows email page.
     */
    function view()
    {   
        $data['title'] = 'Send Email';
        $data['groups'] =  $this->cadetgroup_model->get_all_groups();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/sendemail.php');
        $this->load->view('templates/footer');    
    } 
    
    /*
     * Sends email from email page
     */
    function send()
    {
        
    }
    
}
