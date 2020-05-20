<?php

class Cadet extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('US/Eastern');

        if( !$this->ion_auth->logged_in() )
        {
	        $this->session->set_flashdata('redirect_url', current_url());
	        redirect('login/view');
        }

    }

    /**
     * Selects user to be modified
     */
    function select()
    {
        $data['users'] = $this->ion_auth->users()->result(); // get all users
        $data['title'] = "Modify Cadet";

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('cadet/modifycadet');
        $this->load->view('templates/footer');
    }

    /**
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
    
    /**
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
    
    /**
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

    /**
     * Updates user's profile based on what the cadet enters.
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

    
    /**
     * Saves a cadet's profile picture.
     */ 
    function uploadpic()
    {
//        TODO: Fix this so instead of manipulating a name the file name is stored on the cadet's profile
        $user = $this->ion_auth->user()->row();
        
        $config['upload_path']      = 'images/';
        $config['allowed_types']    = 'jpeg|jpg|png';
        $config['max_size']         = 2048;
        $config['max_width']        = 1000;
        $config['max_height']       = 1000;
        $config['file_name']        = $user->id;

        // If old profile picture exists delete it
        if(is_file('./images/' . $user->image))
        {
            unlink('./images/'. $user->image );
        }

        // Uploads image
        $this->load->library('upload', $config);
        if( !$this->upload->do_upload('profilepicture') ) 
        {
            $data['error'] = $this->upload->display_errors();

            $this->load->view('templates/header', $data);
            $this->load->view('cadet/editProfile');
            $this->load->view('templates/footer');
        }
        else 
        {
            $params = array(
                'image' => $this->upload->data('file_name'),
            );

            $this->ion_auth->update($user->id, $params);

            redirect('cadet/edit');
        } 
    }

    /**
     * Edit user's profile.
     */
    function edit()
    {
        $user = $this->ion_auth->user()->row();

        $data['title'] = 'Edit Profile';
        $data['user'] = $user;

        // Looks for profile picture
        if(is_file('./images/' . $user->image))
        {
            $data['picture'] = base_url("./images/" . $user->image);
        }
        else
        {
            $data['picture'] = base_url("./images/default.jpeg");
        }

        $data['error'] = NULL;

        $this->load->view('templates/header', $data);
        $this->load->view('cadet/editProfile');
        $this->load->view('templates/footer'); 
    } 
    
    /**
     * Shows cadet's profile.
     */
    function profile()
    {
        $user = $this->ion_auth->user()->row();

        $data['title'] = 'Profile Page';
        $data['admin'] = $this->ion_auth->is_admin();

        // Looks for profile picture
        if(is_file('./images/' . $user->image))
        {
            $data['picture'] = base_url("./images/" . $user->image);
        }
        else
        {
            $data['picture'] = base_url("./images/default.jpeg");
        }
        
        $data['user'] = $user;
        $data['heading'] = $user->rank . " " . $user->last_name;
        
        // Allows user to see edit profile button
        $data['myprofile'] = true;
        
        $this->load->view('templates/header', $data);
        $this->load->view('cadet/profile');
        $this->load->view('templates/footer');    
    }
    
    
    /**
     * Shows home page with current greeting.
     */
    function home()
    {
        $data['title'] = "Home";

        $user = $this->ion_auth->user()->row();

        $data['events'] =  Event_model::orderBy('created_at', 'desc')->take(5)->get();
        // TODO: Make these announcements specific to the user
        $data['announcements'] = Announcement_model::with('created_by')
            ->orderBy('created_at', 'desc')->take(5)->get();
        $data['admin'] = $this->ion_auth->is_admin();

        $hour = intval(date("H"));
        if($hour < 12 )
        {
            $data['greeting'] = "Good Morning " . $user->rank . " " . $user->last_name;
        }
        else if( $hour >= 12 && $hour < 17 )
        {
            $data['greeting'] = "Good Afternoon " . $user->rank . " " . $user->last_name;
        }
        else
        {
            $data['greeting'] = "Good Evening " . $user->rank . " " . $user->last_name;
        }

        // Gets pt and llab attendance percentage for the logged in user
        if(date("m") >= 1 && date("m") <= 6)
        {
            $pt = Attendance_model::whereHas('event', function ($query) {
                $query->whereMonth('date', '<=', 6)->where('pt', '=', 1);
            })->with('event')->where('user_id', '=', $user->id)->count();

            $pt_sum = Event_model::whereMonth('date', '<=', 6)->where('pt', '=', 1)->count();

            $llab = Attendance_model::whereHas('event', function ($query) {
                $query->whereMonth('date', '<=', 6)->where('llab', '=', 1);
            })->with('event')->where('user_id', '=', $user->id)->count();

            $llab_sum = Event_model::whereMonth('date', '<=', 6)->where('llab', '=', 1)->count();
        }
        else
        {
            $pt = Attendance_model::whereHas('event', function ($query) {
                $query->whereMonth('date', '>', 6)->where('pt', '=', 1);
            })->with('event')->where('user_id', '=', $user->id)->count();

            $pt_sum = Event_model::whereMonth('date', '>', 6)->where('pt', '=', 1)->count();

            $llab = Attendance_model::whereHas('event', function ($query) {
                $query->whereMonth('date', '>', 6)->where('llab', '=', 1);
            })->with('event')->where('user_id', '=', $user->id)->count();

            $llab_sum = Event_model::whereMonth('date', '>', 6)->where('llab', '=', 1)->count();
        }

        // Checks to see if no pt events have occurred yet
        if($pt_sum == 0)
        {
            $data['ptperc'] = number_format(0, 2);
        }
        else
        {
            $data['ptperc'] = number_format(($pt / $pt_sum) * 100, 2);
        }

        // Checks to see if no llab  events have occurred yet
        if($llab_sum == 0)
        {
            $data['llabperc'] = number_format(0, 2);
        }
        else
        {
            $data['llabperc'] = number_format(($llab / $llab_sum) * 100, 2);
        }

        // Loads the home page 
        $this->load->view('templates/header', $data);
        $this->load->view('home');
        $this->load->view('templates/footer');            
    }
    
    /**
     * Deletes a user.
     */
    function remove()
    {
        if( $this->ion_auth->is_admin() )
        {
            $user = User_model::with('events', 'attendance_records', 'announcements', 'attendance_memos', 'acknowledge_posts')
                ->find($this->input->post('remove'));

            foreach ($user->events as $event)
            {
                $event->created_by_id = NULL;
                $event->save();
            }
            //delete all attendance records pertaining to a given cadet
            foreach ($user->attendance_records as $attendance_record)
            {
                $attendance_record->delete();
            }

            foreach ($user->announcements as $announcement)
            {
                $announcement->created_by_id = NULL;
                $announcement->save();
            }

            foreach ($user->attendance_memos as $attendance_memo)
            {
                $attendance_memo->delete();
            }

            foreach ($user->acknowledge_posts as $acknowledge_post)
            {
                $acknowledge_post->delete();
            }
            
            $user->delete();
            redirect('cadet/view');
        }
    }

    
    /**
     * Updates a cadets admin permissions and rank.
     */
    function modify()
    {
        if( isset($_POST) && count($_POST) > 0 && $this->ion_auth->is_admin() )
        {
            if($this->input->post('admin') === "yes" && !$this->ion_auth->is_admin($this->input->post('modify')))
            {
                // Makes user an admin
                $this->ion_auth->add_to_group(1, $this->input->post('modify'));
            }
            else if($this->input->post('admin') === "no" && $this->ion_auth->is_admin($this->input->post('modify')))
            {
                // Removes admin privileges
                $this->ion_auth->remove_from_group(1, $this->input->post('modify'));
            }

            $params = array(
                'rank' => $this->input->post('rank'),
                'flight' => $this->input->post('flight'),
                'class' => $this->input->post('class')
            );

            $this->ion_auth->update($this->input->post('modify'), $params);
            redirect('cadet/select');
        }
        else
        {
            show_error('You must be an admin and give new user information to change a user\'s information');
        }

    }
    
    /**
     * Add a new user.
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

                if($this->input->post('rfid') !== "")
                {
                    $rfid = $this->input->post('rfid');
                }
                else
                {
                    $rfid = NULL;
                }

                $params = array(
                    'admin' => $this->input->post('admin'),
                    'first_name' => $this->input->post('firstname'),
                    'rank' => $this->input->post('rank'),
                    'class' => $this->input->post('class'),
                    'flight' => $this->input->post('flight'),
                    'last_name' => $this->input->post('lastname'),
                    'rfid' => $rfid,
                    'question' => $this->input->post('question'),
                    'answer' => $this->input->post('answer')
                );

                $username = $this->input->post('rin');
                $email = $this->input->post('email');

                $this->ion_auth->register($username, $pass, $email, $params);

                $message = "<h2>New Account Password</h2>
                        <p>Your new account has been created! Below is your new temporary password please log on and 
                        change it as soon as possible!</p>
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

                $headers = 'From: Detachment 550 Air Force ROTC <noreply@det550.com>' . "\r\n";
                $headers .= "Content-type: text/html\r\n";

                // Send email
                echo mail($this->input->post('email'), 'New Cadet Account', $message, $headers);

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
    
    /**
     * Shows admin page.
     */
    function view()
    {
        if( $this->ion_auth->is_admin() )
        {
            $data['title'] = 'Admin Page';

            $data['users'] = $this->ion_auth->users()->result();
            $data['events'] = Event_model::all();
            $data['announcements'] = Announcement_model::all();
            
            $this->load->view('templates/header', $data);
            $this->load->view('admin/admin');
            $this->load->view('templates/footer'); 
        }
        else
        {
            redirect('cadet/home');
        }
    }
    
    /**
     * Shows page to connect RFID to a user.
     */
    function change_rfid()
    {
        $data['title'] = 'Add RFID';
        $data['users'] = $this->ion_auth->users()->result(); // get all users

        $this->load->view('templates/header', $data);
        $this->load->view('rfid');
        $this->load->view('templates/footer'); 
    }
    
    /**
     * Saves the rfid to user.
     */
    function save_rfid()
    {
        if(isset($_POST) && count($_POST) > 0)
        {
            $data = array(
                'rfid' => $this->input->post('rfid'),
            );

            $this->ion_auth->update($this->input->post('id'), $data);

            redirect('cadet/change_rfid');
        }
        else
        {
            show_error("You must enter both a valid ID and scan the ID card.");
        }
    }
    
    /**
     * Unlocks a users account.
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

    function uploadwingpic()
    {
//        TODO: Fix this so instead of manipulating a name the file name is stored on the cadet's profile
        $user = $this->ion_auth->user()->row();

        $config['upload_path']      = './images/';
        $config['allowed_types']    = 'pdf|jpg|png|jpeg';
        $config['max_size']         = 0;
        $config['max_width']        = 0;
        $config['max_height']       = 0;
        $config['file_name']        = 'orgchart';

        // If old wing structure picture exists delete it
        if(is_file('./images/orgchart.pdf'))
        {
            unlink('./images/orgchart.pdf');
        }
        else if(is_file('./images/orgchart.jpg'))
        {
            unlink('./images/orgchart.jpg');
        }
        else if(is_file('./images/orgchart.png'))
        {
            unlink('./images/orgchart.png');
        }
        else if(is_file('./images/orgchart.jpeg'))
        {
            unlink('./images/orgchart.jpeg');
        }

        // Uploads image
        $this->load->library('upload', $config);
        if( !$this->upload->do_upload('wingpicture') )
        {
            $data['error'] = $this->upload->display_errors();

            $this->load->view('templates/header', $data);
            $this->load->view('wingstructure');
            $this->load->view('templates/footer');
        }
        else
        {
            redirect('cadet/wingstructure');
        }
    }

    /**
     * Shows the cadet wing structure page.
     */
    function wingstructure()
    {
        $data['title'] = 'Cadet Wing Structure';

        //passes the "orgchart" picture file name to the view if it exists.
        if(is_file('./images/orgchart.pdf'))
        {
            $data['picture_location'] = base_url("images/orgchart.pdf");
        }
        else if(is_file('./images/orgchart.jpg'))
        {
            $data['picture_location'] = base_url("images/orgchart.jpg");
        }
        else if(is_file('./images/orgchart.PNG'))
        {
            $data['picture_location'] = base_url("images/orgchart.PNG");
        }
        else if(is_file('./images/orgchart.jpeg'))
        {
            $data['picture_location'] = base_url("images/orgchart.jpeg");
        }
        else
        {
            $data['picture_location'] = '';
        }

        $this->load->view('templates/header', $data);
        $this->load->view('wingstructure');
        $this->load->view('templates/footer');
    }

    /**
     * Returns json data of the inputted user.
     *
     * @param int $user The selected user id
     */
    function info(int $user)
    {
        $data['user'] = $this->ion_auth->user($user)->row();
        $data['admin'] = $this->ion_auth->is_admin($user);

        echo json_encode($data);
    }

}


