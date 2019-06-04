<?php
class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    /*
     * Shows the login page.
     */
    public function view()
    {
        if( $this->ion_auth->logged_in() )
        {
            redirect('cadet/home');
        }
        else
        {
            $data['title'] = 'Login';

            $this->load->view('login', $data);
            $this->load->view('templates/footer');
        }
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
                $data['error'] = "You have been locked out of your account due to 5 incorrect password entries. 
                Please reach out to a site admin or up your chain of commend to resolve this issue.";
            }
            else
            {
                $data['error'] = "Your email or password is incorrect.";
            }

            $this->load->view('login', $data);
            $this->load->view('templates/footer');
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
            $data['title'] = 'Security Question';
            $data['user'] = $this->User_model->find_user_email(trim($this->input->post('email')));

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
        $user = $this->User_model->find_user_email(trim($this->input->post('email')));
        
        if(strcmp($this->input->post('answer'), $user['answer']) == 0)
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

            $params = array(
                'password' => $pass,
                'loginattempt' => 0
            );

            $this->ion_auth->update($user['id'], $params);

            $message = "<h2>Password Reset</h2>
                        <p>The below is your temporary password please change it as soon as possible!</p>
                        <br><br>
                        <p>Temporary Password: " . $pass . "</p>";
            
            $this->load->library('encryption');

            // Load email library
            $this->load->library('email');

            $this->email->bcc($user['email']);
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
        $this->ion_auth->logout();

        redirect('login/view');
    }

}
