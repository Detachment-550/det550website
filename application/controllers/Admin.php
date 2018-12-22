<?php
 
class Admin extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session'); 
        
        if( $this->session->userdata('login') === true )
        {
            $data['admin'] = $this->session->userdata('admin');
            $this->load->model('Cadet_model');
        }
        else
        {
            redirect('login/view');
        }
    }
    
    /*
     * Shows the admin page.
     */
    function view()
    {
        $data['title'] = 'Admin Page';
        $data['cadets'] = $this->Cadet_model->get_all_cadets();
        $this->load->view('templates/header', $data);
        $this->load->view('pages/admin.php');
        $this->load->view('templates/footer');         
    }
    
    /*
     * Deleting cadet
     */
    function remove($rin)
    {
        $cadet = $this->Cadet_model->get_cadet($this->input->post('remove'));

        // check if the cadet exists before trying to delete it
        if(isset($cadet['rin']))
        {
            $this->Cadet_model->delete_cadet($this->input->post('remove'));
            redirect('admin/view');
        }
        else
        {
            show_error('The cadet you are trying to delete does not exist.');
        }
    }
}
