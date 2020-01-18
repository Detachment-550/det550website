<?php

    class Email extends CI_Controller{
        function __construct()
        {
            parent::__construct();
        }

        /**
         * Shows email page.
         */
        function view()
        {
            if( !$this->ion_auth->logged_in() )
            {
                redirect('login/view');
            }
            else
            {
                $data['title'] = 'Send Email';
                $data['groups'] = $this->ion_auth->groups()->result();

                $this->load->view('templates/header', $data);
                $this->load->view('sendemail');
                $this->load->view('templates/footer');
            }
        }

        /**
         * Sends email from email page.
         */
        function send()
        {
            if( !$this->ion_auth->logged_in() )
            {
                redirect('login/view');
            }
            else
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

                    mail(NULL, $this->input->post('subject'), $this->input->post('body'), $headers);

                    // Goes back to email page
                    redirect('email/view');
                }
                else
                {
                    show_error('The email you are trying to send does not have a body and/or subject.');
                }
            }
        }

        /**
         * Sends daily wing email.
         */
        function daily_announcements()
        {
            // Sets the timezone to our time zone
            date_default_timezone_set( "America/New_York" );
            $announcements = Announcement_model::whereDate('created_at', '=', Date('Y-m-d', strtotime('now')))->get();

            if(count($announcements) > 0)
            {
                $message = "<h1 style='text-align:center;'>Daily Announcements</h1>";
                foreach($announcements as $announcement)
                {
                    $message .= "<h2 style='text-align:center;'>" . $announcement->title . "</h2><p>" .
                        "<strong>Subject:</strong> " . $announcement->subject . "</p><p>&nbsp;</p><p>&nbsp;</p>"
                        . $announcement->body . "<br><hr><br>";
                }

                $users = User_model::all(); // get all users
                foreach( $users as $user )
                {
                    $headers = 'From: Detachment 550 Air Force ROTC <noreply@det550.com>' . "\r\n";
                    $headers .= "Content-type: text/html\r\n";
                    echo mail($user->email, 'Wing Email', $message, $headers);
                }

                echo 'Announcements sent...';
            }
        }
    }
