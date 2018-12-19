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
        $this->load->helper('form');
        
        if( $this->input->post('body') != null && $this->input->post('subject') != null)
        {
            $this->load->library('encryption');

            //Load email library
            $this->load->library('email');

            //SMTP & mail configuration
            $config = array(
                'protocol'  => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'afrotcdet550@gmail.com',
                'smtp_pass' => 'silverfalcons550',
                'mailtype'  => 'html',
                'charset'   => 'utf-8'
            );

            $this->email->initialize($config);
            $this->email->set_mailtype("html");
            $this->email->set_newline("\r\n");
            
            $this->load->model('groupmember_model');
            $this->load->model('cadet_model');

            $recipients = array();
            // Goes to each selected group
            if( $this->input->post('groups') !== null )
            {
                foreach( $this->input->post('groups') as $group )
                {
                    $data['members'] =  $this->groupmember_model->get_all_groupmembers( $group );
                    foreach( $data['members'] as $member )
                    {
                        $cadet = $this->cadet_model->get_cadet( $member['rin'] );
                        $recipients[] = $cadet['primaryEmail'];
                    }
                }
            }
        
            // Gets the other recipients put in the to section
            if( $this->input->post('groups') !== null )
            {
                $additionalRecipients =  explode(";", $this->input->post('to'));
                foreach( $additionalRecipients as $recipient )
                {
                    $recipients[] = $recipient;
                }
            }

            $this->email->bcc($recipients);
            $this->email->from('noreply@detachment550.org','MyWebsite');
            $this->email->subject($this->input->post('subject'));
            $this->email->message($this->input->post('body'));
            
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
