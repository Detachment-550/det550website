<?php

class Acknowledge_post extends CI_Controller{
    function __construct()
    {
        parent::__construct();

        if( !$this->ion_auth->logged_in() )
        {
            redirect('login/view');
        }
    }

    /**
     * For a given post get all the users who acknowledged post
     */
    function view()
    {
//        TODO: Fix this to work with new ion auth system
        if(isset($_POST) && count($_POST) > 0)     
        {
            $this->load->model('Announcement_model');

            $data['title'] = "Acknowledgements";
            $data['announcement'] = Announcement_model::with('acknowledgements.user')
                ->find($this->input->post('event'));
            
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
     * Function to add new post with acknowledgement criteria
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {
            $user = $this->ion_auth->user()->row();

            // Ignores duplicate entries
            $post_acknowledgement = Acknowledge_post_model::firstOrCreate(
                ['user_id' => $user->id, 'announcement_id' => $this->input->post('announcementid')]);
            
            redirect('announcement/view');
        }
        else
        {            
            show_error("There was a problem adding an announcement");
        }
    }
    
    /**
     * Returns the number of posts with a given uid
     *
     * @param int $announcement_id Id of post
     *
     * @return number of users that acknowledged the post
     */
    function get_acknowledge_count(int $announcement_id)
    {
        return Announcement_model::with('acknowledgements')->find($announcement_id)->count();
    }
    
}
