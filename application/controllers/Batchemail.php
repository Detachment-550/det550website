<?php

class Batchemail extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Batch_email_model');
        $this->load->library('email');
    }

    /*
     * Sends all scheduled emails for the day
     */
    function schedule()
    {
        // Sets the timezone to our time zone
        date_default_timezone_set( "America/New_York" );

        foreach( $this->Batch_email_model->get_all_batchemails() as $email )
        {
            if( $email['day'] === date("Y-m-d") )
            {
                $headers = 'From: ' . $email['from'] . ' <noreply@det550.com>' . "\r\n";
                $headers .= "Content-type: text/html\r\n";

                mail($email['to'], $email['subject'], $email['message'], $headers);

                // Removes scheduled email from DB after sending it
                $this->Batch_email_model->delete_batchemail( $email['uid'] );
            }
            else
            {
                echo date("Y-m-d") . " is not " . $email['day'] . "<br>";
            }
        }
    }
}
