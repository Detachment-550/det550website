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
            if( $this->input->post('body') != null && $this->input->post('subject') != null)
            {
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

                $headers = 'From: AFROTC Detachment 550 <noreply@det550.com>' . "\r\n";
                $headers .= 'BCC: '. implode(",", $recipients) . "\r\n";
                $headers .= "Content-type: text/html\r\n";

                mail($this->input->post('to'), $this->input->post('subject'), $this->input->post('body'), $headers);

                // Goes back to email page
                redirect('email/view');
            }
            else
            {
                show_error('The email you are trying to send does not have a body and/or subject.');
            }
        }

    }
