<?php
 
class Email extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session'); 
        
        if( $this->ion_auth->logged_in() )
        {
            $this->load->model('Cadetgroup_model');
        }
        else
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
        $data['groups'] =  $this->Cadetgroup_model->get_all_groups();

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
            
            $this->load->model('Groupmember_model');
            $this->load->model('Cadet_model');

            $recipients = array();
            // Goes to each selected group
            if( $this->input->post('groups') !== null )
            {
                foreach( $this->input->post('groups') as $group )
                {
                    $data['members'] =  $this->Groupmember_model->get_all_groupmembers( $group );
                    foreach( $data['members'] as $member )
                    {
                        $cadet = $this->Cadet_model->get_cadet( $member['rin'] );
                        $recipients[] = $cadet['primaryEmail'];
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
