<?php
class Login extends CI_Controller {

    public function view()
    {
        $this->load->library('session');
        if( $this->session->userdata('login') === true )
        {
            redirect('cadet/home');
        }
        $data['title'] = 'Login';

        $this->load->view('pages/login.php', $data);
        $this->load->view('templates/footer');
    }
    
    /*
     * Makes sure cadet is authroized to login.
     */
    function auth()
    {
        $this->load->model('Cadet_model');
        $this->load->library('session');

        $cadet = $this->Cadet_model->get_cadet($this->input->post('rin'));
        
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Login Page';

        // Checks that the password given is correct and that the user isn't locked out of the account
        if( ($this->input->post('psw') !== null && password_verify($this->input->post('psw'), $cadet['password'])) && $cadet['loginattempt'] < 10 )
        {
            $this->load->model('cadetevent_model');
            $this->load->model('announcement_model');
            $this->load->model('attendance_model');
            
            // Resets login attempts on a successful login
            $params = array(
                'loginattempt' => 0
            );
            $this->Cadet_model->update_cadet($this->input->post('rin'),$params);
            
            // Sets session variable and loads closest 5 events
            $this->session->set_userdata('login', true);
            $this->session->set_userdata('rin', $this->input->post('rin'));
            
            // Checks if user is an admin or not
            if( $cadet['admin'] == 1 )
            {
                $this->session->set_userdata('admin', true);
            }
            else
            {
                $this->session->set_userdata('admin', false);
            }
            
            $data['admin'] = $this->session->userdata('admin');
            
            redirect('cadet/home');
        }
        else
        {            
            // Increments login attempt
            if( $cadet['loginattempt'] < 10 )
            {
                $cadet['loginattempt'] += 1;
                
                $params = array(
                    'loginattempt' => $cadet['loginattempt']
                );

                $this->Cadet_model->update_cadet($this->input->post('rin'),$params);
            }  
            
            // If you are locked out of the account show error
            if( $cadet['loginattempt'] >= 10 )
            {
                show_error("You have been locked out of your account due to 10 inccorect password entries. Please reach out to a site admin or up your chain of commend to resolve this issue.");
            }
            else 
            {
                $this->load->view('pages/login.php', $data);
                $this->load->view('templates/footer');
            }
        }   
    }
    
    
    /*
     * Loads forgot password page.
     */
    function forgot()
    {
        $data['title'] = 'Forgot Password';
        
        $this->load->view('pages/forgotpass.php', $data);
        $this->load->view('templates/footer');
    }
   
    /*
     * Displays the security question for a given cadet.
     */
    function question()
    {
        if(isset($_POST) && $_POST > 0)
        {
            $this->load->model('Cadet_model');
            
            $data['title'] = 'Security Question';
            $data['cadet'] = $this->Cadet_model->get_cadet($this->input->post('rin'));
            $data['rin'] = $this->input->post('rin');
            
            $this->load->view('pages/passwordreset.php', $data);
            $this->load->view('templates/footer');
        }
        else
        {
            show_error('You must give the RIN of the cadet whose password you are trying to reset.');
        }

    }
    
    /*
     * Resets user's password and emails them the new password.
     */
    function resetpass()
    {
        $this->load->model('Cadet_model');
        $this->load->library('session');

        $cadet = $this->Cadet_model->get_cadet($this->input->post('rin'));
        
        $email[] = $cadet['primaryEmail'];
        
        if(strcmp($this->input->post('answer'), $cadet['answer']) == 0)
        {
            // Generates random password
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); // Remember to declare $pass as an array
            $alphaLength = strlen($alphabet) - 1; // Put the length -1 in cache
            for ($i = 0; $i < 10; $i++) 
            {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            $pass = implode($pass); // Turn the array into a string
            
            $hash = password_hash($pass, PASSWORD_DEFAULT);

            $params = array(
                'password' => $hash
            );

            $this->Cadet_model->update_cadet($this->input->post('rin'), $params); 

            $message = "<h2>Password Reset</h2>
                        <p>The below is your temporary password please change it as soon as possible!</p>
                        <br><br>
                        <p>Temporary Password: " . $pass . "</p>";
            
            $this->load->library('encryption');

            // Load email library
            $this->load->library('email');

            // SMTP & mail configuration
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
            $recipients[] = $cadet['primaryEmail'];

            $this->email->bcc($email);
            $this->email->from('noreply@detachment550.org','MyWebsite');
            $this->email->subject('Password Reset');
            $this->email->message($message);
            
            // Send email
            $this->email->send();
            
            redirect('login/view');
        }
        else
        {
            show_error( "The email you provided does not match the primary email we have on record for " . $cadet['firstName'] . " " . $cadet['lastName'] );
        }
    }
    
    /*
     * Logs user out of website.
     */
    function logout()
    {
        $this->load->library('session');
        $data['title'] = 'Login Page';
        
        $this->session->sess_destroy();

        $this->load->view('pages/login.php', $data);
        $this->load->view('templates/footer');
    }
    
    
//    // (string) $message - message to be passed to Slack
//    // (string) $room - room in which to write the message, too
//    // (string) $icon - You can set up custom emoji icons to use with each message
//    function test( $room = "general", $icon = ":longbox:") 
//    {
//        $room = ($room) ? $room : "engineering";
//        $data = "payload=" . json_encode(array(
//                "channel"       =>  "#{$room}",
//                "text"          =>  "hello",
//                "icon_emoji"    =>  $icon
//            ));
//	
//	// You can get your webhook endpoint from your Slack settings
//        $ch = curl_init("https://hooks.slack.com/services/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");
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $result = curl_exec($ch);
//        curl_close($ch);
//	
//	// Laravel-specific log writing method
//        // Log::info("Sent to Slack: " . $message, array('context' => 'Notifications'));
//        return $result;
//    }
//    
//    function try()
//    {
//        $this->load->view('pages/test.php');
//    }
}

?>