<?php
class Login extends CI_Controller {

    public function view()
    {
        $this->load->library('session');
        if( $this->ion_auth->logged_in() )
        {
            redirect('cadet/home');
        }
        $data['title'] = 'Login';

        $this->load->view('login', $data);
        $this->load->view('templates/footer');
    }
    
    /*
     * Makes sure cadet is authorized to login.
     */
    function auth()
    {
        $identity = trim($this->input->post('user'));
        $password = $this->input->post('psw');

        $data['title'] = 'Login Page';

        // Checks that the password given is correct and that the user isn't locked out of the account
        if( !$this->ion_auth->is_max_login_attempts_exceeded($identity) && $this->ion_auth->login($identity, $password) )
        {
            redirect('cadet/home');
        }
        else
        {
            // If you are locked out of the account show error
            if( $this->ion_auth->is_max_login_attempts_exceeded($identity) )
            {
                show_error("You have been locked out of your account due to 10 incorrect password entries. 
                Please reach out to a site admin or up your chain of commend to resolve this issue.");
            }
            else
            {
                $this->load->view('login', $data);
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
        
        $this->load->view('cadet/forgotpass', $data);
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
            
            $this->load->view('cadet/passwordreset', $data);
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
                'password' => $hash,
                'loginattempt' => 0
            );

            $this->Cadet_model->update_cadet($this->input->post('rin'), $params); 

            $message = "<h2>Password Reset</h2>
                        <p>The below is your temporary password please change it as soon as possible!</p>
                        <br><br>
                        <p>Temporary Password: " . $pass . "</p>";
            
            $this->load->library('encryption');

            // Load email library
            $this->load->library('email');

            $this->email->bcc($email);
            $this->email->from('noreply@detachment550.org','Air Force ROTC Detachment 550');
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

        $this->load->view('login', $data);
        $this->load->view('templates/footer');
    }

}
