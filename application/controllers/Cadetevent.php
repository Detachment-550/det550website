<?php

class Cadetevent extends CI_Controller{
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
     * Loads the cadet event page.
     */
    function view()
    {
        if(isset($_POST) && count($_POST) > 0)
        {
            redirect('cadetevent/event/' . $this->input->post('event'));
        }
        else
        {
            show_error("You must provide an event to view");
        }
    }

    /**
     * Displays the event
     *
     * @param int $event The event to display
     */
    function event(int $event)
    {
        $data['event'] = Event_model::find( $event );
        $data['users'] = $this->ion_auth->users()->result(); // get all users
        $data['title'] = 'Set Attendance';

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('attendance/attend');
        $this->load->view('templates/footer');
    }

    /**
     * Adds a new cadet event.
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {
            $user = $this->ion_auth->user()->row();

            if($this->input->post('type') === "pt")
            {
                $pt = 1;
                $llab = 0;
            }
            else if($this->input->post('type') === "llab")
            {
                $pt = 0;
                $llab = 1;
            }
            else
            {
                $pt = 0;
                $llab = 0;
            }

            $event = new Event_model();
            $event->name = $this->input->post('name');
            $event->date = $this->input->post('date');
            $event->pt = $pt;
            $event->llab = $llab;
            $event->created_by_id = $user->id;
            $event->save();

            redirect('attendance/admin');
        }
        else
        {            
            show_error("Something went wrong with adding a new cadet event");
        }
    }

    /**
     * Deletes a cadet event.
     */
    function remove()
    {
        if(isset($_POST) && count($_POST) > 0)
        {
            Event_model::find($this->input->post('event'))->delete();
            redirect('attendance/admin');
        }
        else
        {
            show_error("Something went wrong with adding a new cadet event");
        }
    }
}
