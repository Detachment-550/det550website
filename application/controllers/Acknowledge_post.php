<?php

class Acknowledge_post extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session'); 
        
        if( $this->ion_auth->logged_in() )
        {
            $this->load->model('Acknowledge_post_model');
        }
        else
        {
            redirect('login/view');
        }
    } 

    function view()
    {
//        TODO: Fix this to work with new ion auth system
        if(isset($_POST) && count($_POST) > 0)     
        {
            $data['title'] = "Acknowledgements"; 
            $this->load->model('Announcement_model');
            $this->load->model('Cadet_model');
            $data['announcement'] = $this->Announcement_model->get_announcement($this->input->post('event'));
            $data['acknowledgements'] = $this->Acknowledge_post_model->get_event_acknowledge_posts($this->input->post('event'));
            $cadets = array();
            
            foreach( $data['acknowledgements'] as $ack )
            {
                $cadets[] = $this->Cadet_model->get_cadet($ack['rin']);
            }
            
            $data['cadets'] = $cadets;
            
            $this->load->view('templates/header', $data);
            $this->load->view('announcement/acknowledged.php');
            $this->load->view('templates/footer'); 
        }
        else
        {
            show_error('The announcement you are trying to view acknowledgements for does not exist.');
        }
    }

    /*
     * Adding a new acknowledge_post
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {
            $user = $this->ion_auth->user()->row();

            // Ignores duplicate entries
            if( $this->Acknowledge_post_model->acknowledge_post_exists( $user->id, $this->input->post('announcementid') ) <= 0 )
            {
                $params = array(
                    'rin' =>  $this->session->userdata('rin'),
                    'announcement_id' => $this->input->post('announcementid')
                );
                
                $this->Acknowledge_post_model->add_acknowledge_post($params);
            }
            
            redirect('announcement/view');
        }
        else
        {            
            show_error("There was a problem adding an announcement");
        }
    }
    
    /*
     * Returns the number of posts with a given uid
     */
    function get_acknowledge_count($announcement_id)
    {
        return $this->Acknowledge_post_model->get_acknowledge_post_count($announcement_id);
    }

    /*
     * Deleting acknowledge_post
     */
    function remove($rin)
    {
        $acknowledge_post = $this->Acknowledge_post_model->get_acknowledge_post($rin);

        // check if the acknowledge_post exists before trying to delete it
        if(isset($acknowledge_post['rin']))
        {
            $this->Acknowledge_post_model->delete_acknowledge_post($rin);
            redirect('acknowledge_post/index');
        }
        else
            show_error('The acknowledge_post you are trying to delete does not exist.');
    }
    
}
