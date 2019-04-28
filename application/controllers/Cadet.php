<?php

class Cadet extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session'); 
        
        if( $this->ion_auth->logged_in() )
        {
            $this->load->model('Cadet_model');
            $data['admin'] = $this->session->userdata('admin');
        }
        else
        {
            redirect('login/view');
        }
    } 

    /*
     * Selects a cadet to be modified
     */
    function select()
    {
        if( $this->input->post('modify') !== null )
        {
            $data['cadet'] = $this->Cadet_model->get_cadet( $this->input->post('modify') );
            $data['title'] = "Modify Cadet";

            // Loads the home page
            $this->load->view('templates/header', $data);
            $this->load->view('cadet/modifycadet');
            $this->load->view('templates/footer');
        }
        else
        {
            show_error('You must select a cadet to be modified');
        }
    }

    /*
     * Saves response to security question
     */
    function saveanswer()
    {
        if( $this->input->post('question') !== null && $this->input->post('answer') !== null )
        {
            $params = array(
                'question' => $this->input->post('question'),
                'answer' => $this->input->post('answer')
            );

            $this->Cadet_model->update_cadet($this->session->userdata('rin'),$params);            
            redirect('cadet/edit');        
        }
        else
        {
            show_error('You must provide a question and answer to set your security question.');
        }
    }
    
    /*
     * Shows the view of setting a cadet's security question.
     */
    function security()
    {
        $data['title'] = 'Security Question';
        $data['cadet'] = $this->Cadet_model->get_cadet($this->input->post('rin'));

        $this->load->view('templates/header', $data);
        $this->load->view('cadet/securityquestion');
        $this->load->view('templates/footer');     
    }
    
    /*
     * Changes a cadet's password.
     */
    function changepassword()
    {
        $cadet = $this->Cadet_model->get_cadet($this->session->userdata('rin'));
        
        $password = $cadet['password'];
        if(isset($_POST) && $_POST > 0)
        {
            if(password_verify( $this->input->post('oldpass'), $password ))
            {
                if($this->input->post('newpass') === $this->input->post('verpass'))
                {
                    $params = array(
					   'password' => password_hash( $this->input->post('newpass'), PASSWORD_DEFAULT )
                    );

                    $this->Cadet_model->update_cadet($this->session->userdata('rin'),$params);            
                    redirect('cadet/edit');
                }
                else
                {
                    show_error('The two passwords you entered do not match.');
                }
            }
            else
            {
                show_error('The password you provided does not match you current password.');
            }
        }
        else
        {
            redirect('cadet/edit');
        }
    }

    /*
     * Updates a cadet's profile
     */
    function saveprofile()
    {
        $data['title'] = 'Edit Profile';

        // check if the cadet exists before trying to edit it
        $data['cadet'] = $this->Cadet_model->get_cadet($this->session->userdata('rin'));

        if(isset($data['cadet']['rin']))
        {
            if(isset($_POST) && count($_POST) > 0)
            {
                $params = array(
                    'awards' => $this->input->post('awards'),
                    'PGoals' => $this->input->post('pgoals'),
                    'AFGoals' => $this->input->post('afgoals'),
                    'bio' => $this->input->post('bio'),
                    'primaryEmail' => $this->input->post('pemail'),
                    'primaryPhone' => $this->input->post('pphone'),
                    'position' => $this->input->post('position'),
                    'major' => $this->input->post('major')
                );

                $this->Cadet_model->update_cadet($this->session->userdata('rin'),$params);

                redirect('cadet/edit');
            }
            else
            {
                show_error('There was no information given to save in your profile.');
            }
        }
        else
        {
            show_error('The cadet you are trying to edit does not exist.');
        }
    }

    
    /*
     * Saves a cadet's profile picture.
     */ 
    function uploadpic()
    {
        // check if the cadet exists before trying to edit it
        $data['cadet'] = $this->Cadet_model->get_cadet($this->session->userdata('rin'));
        
        // TODO: Account for max file sizes
        $config['upload_path']      = './images/';
        $config['allowed_types']    = 'jpeg|jpg|png';
        $config['max_size']         = 100000;
        $config['max_width']        = 20000;
        $config['max_height']       = 20000;
        $config['file_name']        = $data['cadet']['rin'];

        // If old profile picture exists delete it
        if( file_exists("./images/" . $data['cadet']['rin'] . ".png") || file_exists("./images/" . $data['cadet']['rin'] . ".jpg") || file_exists("./images/" . $data['cadet']['rin'] . ".jpeg"))
        {
            unlink("./images/" . $data['cadet']['rin'] . ".png");
            unlink("./images/" . $data['cadet']['rin'] . ".jpg");
            unlink("./images/" . $data['cadet']['rin'] . ".jpeg");
        }
        
        // Uploads image
        $this->load->library('upload', $config);
        if( !$this->upload->do_upload('profilepicture') ) 
        {
            $error = array('error' => $this->upload->display_errors()); 
            redirect('cadet/edit');
        }
        else 
        { 
            $data = array('upload_data' => $this->upload->data()); 
            redirect('cadet/edit');
        } 
    }

    /*
     * Editing a cadet
     */
    function edit()
    {   
        $data['title'] = 'Edit Profile';
        $data['cadet'] = $data['cadet'] = $this->Cadet_model->get_cadet($this->session->userdata('rin'));

        // Looks for profile picture
        $files = array_diff(scandir("./images"), array('.', '..'));
        $found = false;
        $data['files'] = $files;
        foreach($files as $file)
        {
            $info = pathinfo($file);
            if($info['filename'] == $_SESSION['rin'])
            {
                $data['picture'] = $info['basename'];
                $found = true;
            }
        }
        if(!$found)
        {
            $data['picture'] = "/images/default.jpeg";
        }

        $this->load->view('templates/header', $data);
        $this->load->view('cadet/editProfile');
        $this->load->view('templates/footer'); 
    } 
    
    /*
     * Shows cadet's profile.
     */
    function profile()
    {        
        $data['title'] = 'Profile Page';
        $data['admin'] = $this->session->userdata('admin');
        
        // Looks for profile picture
        $files = array_diff(scandir("./images"), array('.', '..'));
        $found = false;
        $data['files'] = $files;
        foreach($files as $file)
        {
            $info = pathinfo($file);
            if($info['filename'] == $_SESSION['rin'])
            {
                $data['picture'] = $info['basename']; 
                $found = true;
            }
        }
        if(!$found)
        {
            $data['picture'] = "/images/default.jpeg";
        }
        
        $data['cadet'] = $this->Cadet_model->get_cadet($this->session->userdata('rin'));
        
        if(strpos($data['cadet']['rank'], "AS") !== false || strpos($data['cadet']['rank'], "None") !== false)
        {
            $data['heading'] = "Cadet " . $data['cadet']['lastName'];
        }
        else
        {
            $data['heading'] = $data['cadet']['rank'] . " " . $data['cadet']['lastName'];
        } 
        
        // Allows user to see edit profile button
        $data['myprofile'] = true;
        
        $this->load->view('templates/header', $data);
        $this->load->view('cadet/profile');
        $this->load->view('templates/footer');    
    }
    
    
    /*
     * Shows cadet's home page.
     */
    function home()
    {
        $data['title'] = "Home";
        $this->load->model('Cadetevent_model');
        $this->load->model('Announcement_model');
        $this->load->model('Attendance_model');

        $data['events'] =  $this->Cadetevent_model->get_last_five_events();
        $data['announcements'] =  $this->Announcement_model->get_last_five_announcements();
        $data['admin'] = $this->ion_auth->is_admin();

        $user = $this->ion_auth->user()->row();

        // Gets pt and llab attendance percentage
        $pt = $this->Attendance_model->get_event_total('pt',$user->username);
        $llab = $this->Attendance_model->get_event_total('llab',$user->username);
        $ptSum = $this->Cadetevent_model->get_event_total('pt');
        $llabSum = $this->Cadetevent_model->get_event_total('llab');

        // Checks to see if no pt events have occurred yet
        if($ptSum == 0)
        {
            $data['ptperc'] = number_format(0, 2);
        }
        else
        {
            $data['ptperc'] = number_format(($pt / $ptSum) * 100, 2);
        }

        // Checks to see if no llab  events have occurred yet
        if($llabSum == 0)
        {
            $data['llabperc'] = number_format(0, 2);
        }
        else
        {
            $data['llabperc'] = number_format(($llab / $llabSum) * 100, 2);
        }

        // Loads the home page 
        $this->load->view('templates/header', $data);
        $this->load->view('home');
        $this->load->view('templates/footer');            
    }
    
    /*
     * Deleting cadet
     */
    function remove()
    {
        if( $this->session->userdata('admin') )
        {
            $data['admin'] = $this->session->userdata('admin');
            $cadet = $this->Cadet_model->get_cadet($this->input->post('remove'));

            // check if the cadet exists before trying to delete it
            if(isset($cadet['rin']))
            {
                $this->Cadet_model->delete_cadet($this->input->post('remove'));
                redirect('cadet/view');
            }
            else
            {
                show_error('The cadet you are trying to delete does not exist.');
            }
        }
    }

    
    /*
     * Updates a cadets permissions and rank
     */
    function modify()
    {
        if( $this->session->userdata('admin') )
        {
            if( $this->input->post('admin') !== null && $this->input->post('rank') !== null && $this->input->post('flight') !== null )
            {
                $params = array(
                    'admin' => $this->input->post('admin'),
                    'rank' => $this->input->post('rank'),
                    'flight' => $this->input->post('flight')
                );

                $this->Cadet_model->update_cadet($this->input->post('modify'),$params);            
                redirect('cadet/view');
            }
            else
            {
                show_error('You must provide a question and answer to set your security question.');
            }
        }
    }
    
    /*
     * Adding a new cadet
     */
    function add()
    {   
        if( $this->session->userdata('admin') )
        {
            if(isset($_POST) && count($_POST) > 0)     
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
                    'admin' => $this->input->post('admin'),
                    'password' => $hash,
                    'firstName' => $this->input->post('firstname'),
                    'rin' => $this->input->post('rin'),
                    'rank' => $this->input->post('rank'),
                    'primaryEmail' => $this->input->post('primaryEmail'),
                    'flight' => $this->input->post('flight'),
                    'lastName' => $this->input->post('lastname'),
                    'rfid' => $this->input->post('rfid'),
                    'question' => $this->input->post('question'),
                    'answer' => $this->input->post('answer')
                );

                $this->Cadet_model->add_cadet($params);

                $message = "<h2>New Account Password</h2>
                        <p>Your new account has been created! Below is your new temporary password please log on and change it as soon as possible!</p>
                        <br><br>
                        <p>Temporary Password: " . $pass . "</p>" . "
                        <p>There are a few things you will need to do once you log on:</p>
                        <ol>
                        <li>Change your password to something you will remember.</li>
                        <li>Create a security question.</li>
                        <li>Update your profile information and add a professional picture of yourself.</li>
                        <li>Explore the site!</li>
                        </ol>
                        <p>&nbsp;</p>
                        <div>--<br class=\"\" />Very Respectfully,</div>
                        <div>&nbsp;</div>
                        <div>ECPA Flight</div>";

                // Load email library
                $this->load->library('email');
                $this->load->library('encryption');

                $this->email->to($this->input->post('primaryEmail'));
                $this->email->from('noreply@detachment550.org','Air Force ROTC Detachment 550');
                $this->email->subject('New Cadet Account');
                $this->email->message($message);

                // Send email
                $this->email->send();

                redirect('cadet/view');

            }
            else
            {            
                show_error('The cadet you are trying to edit does not exist. Or improper information to add cadet was given.');
            }
        }
    }  
    
    /*
     * Shows the admin page.
     */
    function view()
    {
        if( $this->session->userdata('admin') )
        {
            $data['title'] = 'Admin Page';
            $this->load->model('Cadetevent_model');
            $this->load->model('Announcement_model');

            $data['cadets'] = $this->Cadet_model->get_all_cadets();
            $data['events'] = $this->Cadetevent_model->get_all_cadetevents();
            $data['announcements'] = $this->Announcement_model->get_all_announcements();
            
            $this->load->view('templates/header', $data);
            $this->load->view('admin/admin');
            $this->load->view('templates/footer'); 
        }
        else
        {
            redirect('cadet/home');
        }
    }
    
    /*
     * Shows page to connect rfid to a cadet.
     */
    function changerfid()
    {
        $data['title'] = 'Add RFID';
        
        $this->load->view('templates/header', $data);
        $this->load->view('rfid');
        $this->load->view('templates/footer'); 
    }
    
    /*
     * Saves the rfid to a given cadet based off of a rin.
     */
    function saverfid()
    {
        if( $this->input->post('rin') !== null && $this->input->post('rfid') !== null )
        {
            $cadetrin = trim($this->input->post('rin'));
            $cadetrfid = trim($this->input->post('rfid'));

            $params = array(
                'rfid' => $cadetrfid
            );

            $this->Cadet_model->update_cadet($cadetrin, $params);
            
            redirect('cadet/view');
        }
        else
        {
            show_error("You must enter both a valid RIN and scan the ID card.");
        }
    }
    
    /*
     * Unlocks a users account
     */
    function unlock()
    {
        if( $this->input->post('cadet') !== null && $this->session->userdata('admin') )
        {
            $params = array(
                'loginattempt' => 0
            );

            $this->Cadet_model->update_cadet($this->input->post('cadet'), $params);
            
            redirect('cadet/view');
        }
        else
        {
            show_error("The cadet whose account you are trying to unlock does not exist.");
        }
    }

    /*
     * Shows the cadet wing structure page.
     */
    function wingstructure()
    {
        $data['title'] = 'Cadet Wing Structure';

        $this->load->view('templates/header', $data);
        $this->load->view('wingstructure');
        $this->load->view('templates/footer');
    }
}
