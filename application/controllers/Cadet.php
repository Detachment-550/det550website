<?php

class Cadet extends CI_Controller{
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
     * Selects a cadet to be modified
     */
    function select()
    {
//        TODO: Fix this so it redirects to a page where it doesn't repost data on a refresh
        if( $this->input->post('modify') !== null )
        {
            $data['user'] = $this->ion_auth->user($this->input->post('modify'))->row();
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
            $user = $this->ion_auth->user()->row();

            $params = array(
                'question' => $this->input->post('question'),
                'answer' => $this->input->post('answer')
            );

            $this->ion_auth->update($user->id, $params);
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
        $data['user'] = $this->ion_auth->user()->row();

        $this->load->view('templates/header', $data);
        $this->load->view('cadet/securityquestion');
        $this->load->view('templates/footer');     
    }
    
    /*
     * Changes logged in user's password.
     */
    function changepassword()
    {
        $user = $this->ion_auth->user()->row();

        if(isset($_POST) && $_POST > 0)
        {
            if($this->ion_auth->verify_password($this->input->post('oldpass'), $user->password))
            {
                if($this->input->post('newpass') === $this->input->post('verpass'))
                {
                    $params = array(
					   'password' => $this->input->post('newpass'),
                    );

                    $this->ion_auth->update($user->id, $params);
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
        $user = $this->ion_auth->user()->row();

        // check if the cadet exists before trying to edit it
        $data['user'] = $user;

        if(isset($_POST) && count($_POST) > 0)
        {
            $params = array(
                'awards' => $this->input->post('awards'),
                'goals' => $this->input->post('pgoals'),
                'afgoals' => $this->input->post('afgoals'),
                'bio' => $this->input->post('bio'),
                'email' => $this->input->post('pemail'),
                'phone' => $this->input->post('pphone'),
                'position' => $this->input->post('position'),
                'major' => $this->input->post('major')
            );

            $this->ion_auth->update($user->id, $params);

            redirect('cadet/edit');
        }
        else
        {
            show_error('There was no information given to save in your profile.');
        }
    }

    
    /*
     * Saves a cadet's profile picture.
     */ 
    function uploadpic()
    {
//        TODO: Fix this so instead of manipulating a name the file name is stored on the cadet's profile
        $user = $this->ion_auth->user()->row();
        
        $config['upload_path']      = 'images/';
        $config['allowed_types']    = 'jpeg|jpg|png';
        $config['max_size']         = 100000;
        $config['max_width']        = 20000;
        $config['max_height']       = 20000;
        $config['file_name']        = $user->id;

        // If old profile picture exists delete it
        if( file_exists('./images/'. $user->id . ".png"))
        {
            unlink('./images/'. $user->id . ".png");

        }
        if(file_exists('./images/'. $user->id . ".jpg"))
        {
            unlink('./images/'. $user->id . ".jpg");

        }
        if(file_exists('./images/'. $user->id . ".jpeg"))
        {
            unlink('./images/'. $user->id . ".jpeg");

        }

        // Uploads image
        $this->load->library('upload', $config);
        if( !$this->upload->do_upload('profilepicture') ) 
        {
            $data['error'] = $this->upload->display_errors();

            $this->load->view('templates/header', $data);
            $this->load->view('cadet/editProfile');
            $this->load->view('templates/footer');         }
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
        $user = $this->ion_auth->user()->row();

        $data['title'] = 'Edit Profile';
        $data['user'] = $user;

        // Looks for profile picture
        $files = array_diff(scandir("./images"), array('.', '..'));
        $found = false;
        $data['files'] = $files;
        foreach($files as $file)
        {
            $info = pathinfo($file);
            if($info['filename'] == $user->id)
            {
                $data['picture'] = base_url( '/images/' . $info['basename']);
                $found = true;
            }
        }
        if(!$found)
        {
            $data['picture'] = base_url("/images/default.jpeg");
        }
        $data['error'] = NULL;

        $this->load->view('templates/header', $data);
        $this->load->view('cadet/editProfile');
        $this->load->view('templates/footer'); 
    } 
    
    /*
     * Shows cadet's profile.
     */
    function profile()
    {
        $user = $this->ion_auth->user()->row();

        $data['title'] = 'Profile Page';
        $data['admin'] = $this->ion_auth->is_admin();
        
        // Looks for profile picture
        $files = array_diff(scandir("./images"), array('.', '..'));
        $found = false;
        $data['files'] = $files;
        foreach($files as $file)
        {
            $info = pathinfo($file);
            if($info['filename'] == $user->id)
            {
                $data['picture'] = base_url( '/images/' . $info['basename']);
                $found = true;
            }
        }
        if(!$found)
        {
            $data['picture'] = "/images/default.jpeg";
        }
        
        $data['user'] = $user;

        $data['heading'] = $user->rank . " " . $user->last_name;
        
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
        if( $this->ion_auth->is_admin() )
        {
            $this->ion_auth->delete_user($this->input->post('remove'));
            redirect('cadet/view');
        }
    }

    
    /*
     * Updates a cadets permissions and rank
     */
    function modify()
    {
        if( $this->ion_auth->is_admin() )
        {
            if( $this->input->post('admin') !== null && $this->input->post('rank') !== null && $this->input->post('flight') !== null )
            {
                $params = array(
                    'admin' => $this->input->post('admin'),
                    'rank' => $this->input->post('rank'),
                    'flight' => $this->input->post('flight'),
                    'class' => $this->input->post('class')
                );

                $this->ion_auth->update($this->input->post('modify'), $params);
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
        if( $this->ion_auth->is_admin() )
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

                $params = array(
                    'admin' => $this->input->post('admin'),
                    'firstName' => $this->input->post('firstname'),
                    'rank' => $this->input->post('rank'),
                    'class' => $this->input->post('class'),
                    'flight' => $this->input->post('flight'),
                    'lastName' => $this->input->post('lastname'),
                    'rfid' => $this->input->post('rfid'),
                    'question' => $this->input->post('question'),
                    'answer' => $this->input->post('answer')
                );

                $username = $this->input->post('rin');
                $email = $this->input->post('email');

                $this->ion_auth->register($username, $pass, $email, $params);

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
        else
        {
            show_error("You must be an admin to add a new user");
        }
    }  
    
    /*
     * Shows the admin page.
     */
    function view()
    {
        if( $this->ion_auth->is_admin() )
        {
            $data['title'] = 'Admin Page';
            $this->load->model('Cadetevent_model');
            $this->load->model('Announcement_model');

            $data['users'] = $this->ion_auth->users()->result();
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
//       TODO: Fix this to work with the new auth system
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
        if( $this->input->post('user') !== null && $this->ion_auth->is_admin() )
        {
            $this->ion_auth->clear_login_attempts($this->input->post('user'));

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
