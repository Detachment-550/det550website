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
            $this->load->model('Announcement_model');

            $data['title'] = "Acknowledgements"; 
            $data['announcement'] = $this->Announcement_model->get_announcement($this->input->post('event'));
            $data['acknowledgements'] = $this->Acknowledge_post_model->get_event_acknowledge_posts($this->input->post('event'));

            $users = NULL;
            foreach( $data['acknowledgements'] as $ack )
            {
                $users[] = $this->ion_auth->user($ack['user'])->row();
            }
            
            $data['users'] = $users;
            
            $this->load->view('templates/header', $data);
            $this->load->view('announcement/acknowledged.php');
            $this->load->view('templates/footer'); 
        }
        else
        {
            show_error('The announcement you are trying to view acknowledgements for does not exist.');
        }
    }

    /**
     * Adding a new acknowledge_post
     **/
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {
            $user = $this->ion_auth->user()->row();

            // Ignores duplicate entries
            if( $this->Acknowledge_post_model->acknowledge_post_exists( $user->id, $this->input->post('announcementid') ) <= 0 )
            {
                $params = array(
                    'user' =>  $user->id,
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
    
}
