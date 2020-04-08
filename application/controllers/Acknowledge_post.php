<?php

class Acknowledge_post extends CI_Controller{
    function __construct()
    {
        parent::__construct();

        if( !$this->ion_auth->logged_in() )
        {
	        $this->session->set_flashdata('redirect_url', current_url());
	        redirect('login/view');
        }
    }

    /**
     * For a given post get all the users who acknowledged post
     */
    function view()
    {
        if(isset($_POST) && count($_POST) > 0)
        {
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
    function add(int $announcement_id)
    {   
        $user = $this->ion_auth->user()->row();

        // Ignores duplicate entries
        if(!Acknowledge_post_model::where('user_id', '=', $user->id)->where('announcement_id', '=', $announcement_id)->exists())
        {
            $ack_post = new Acknowledge_post_model();
            $ack_post->user_id = $user->id;
            $ack_post->announcement_id = $announcement_id;
            $ack_post->save();
            echo json_encode($ack_post);
        }
        
        echo json_encode(NULL);
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
