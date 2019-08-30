<?php
 
class Email extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session'); 
        
        if( !$this->ion_auth->logged_in() )
        {
            redirect('login/view');
        }
    } 

    /*
     * Shows email page.
     */
    function view()
    {   
        $data['title'] = 'Send Email';
        $data['groups'] = $this->ion_auth->groups()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('sendemail');
        $this->load->view('templates/footer');    
    } 
    
    /*
     * Sends email from email page
     */
    function send()
    {
        $this->load->helper('form');
        
        if( $this->input->post('body') != null && $this->input->post('subject') != null)
        {
            $this->load->library('encryption');
            $this->load->library('email');
            
            $recipients = array();
            // Goes to each selected group
            if( $this->input->post('groups') !== null )
            {
                foreach( $this->input->post('groups') as $group )
                {
                    $members = $this->ion_auth->users($group)->result(); // get users from given group

                    foreach( $members as $member )
                    {
                        $recipients[] = $member->email;
                    }
                }
            }
        
            // Gets the other recipients put in the to section
            if( $this->input->post('to') !== null )
            {
                $additionalRecipients =  explode(";", $this->input->post('to'));
                foreach( $additionalRecipients as $recipient )
                {
                    $recipients[] = $recipient;
                }
            }

            $this->email->bcc( $recipients );
            $this->email->from('noreply@detachment550.org','Air Force ROTC Detachment 550');
            $this->email->subject( $this->input->post('subject') );
            $this->email->message( $this->input->post('body') );
            
            //Send email
            $this->email->send();
            
            // Goes back to email page
            redirect('email/view');
        }
        else
        {
            show_error('The email you are trying to send does not have a body and/or subject.');
        }
    }

}
