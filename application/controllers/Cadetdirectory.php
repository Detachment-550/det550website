<?php

class Cadetdirectory extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        if( !$this->ion_auth->logged_in() )
        {
            redirect('login/view');
        }
    } 

    /**
     * Shows all cadets based on a given major.
     */
    function major()
    {
//        TODO: Make this searchable again
        $data['title'] = 'Cadet Directory';

        $data['users'] = $this->ion_auth->users()->row();
        $data['selected'] = $this->input->post('showcadets');

        $this->load->view('templates/header', $data);
        $this->load->view('directory');
        $this->load->view('templates/footer'); 
    }
    
    /**
     * Shows all of the cadets in the detachment.
     */
    function view()
    {
        $data['title'] = 'Cadet Directory';
        $data['users'] = User_model::orderBy('last_name', 'asc')->get();

        $this->load->view('templates/header', $data);
        $this->load->view('directory');
        $this->load->view('templates/footer'); 
    }


    /**
     * Shows all of the cadets in the detachment.
     */
    function search()
    {
        if(isset($_POST) && count($_POST) > 0)
        {
            $search_field = $this->input->post('search_field');
            if($search_field === 'last_name')
            {
                $data['title'] = 'Cadet Directory';
                $data['users'] = User_model::orderBy('last_name', 'asc')
                    ->where('last_name', 'like', '%' . $this->input->post('search_value') . '%')
                    ->get();
            }
            else if($search_field === 'major')
            {
                $data['title'] = 'Cadet Directory';
                $data['users'] = User_model::orderBy('last_name', 'asc')
                    ->where('major', 'like', '%' . $this->input->post('search_value') . '%')
                    ->get();
            }

            $this->load->view('templates/header', $data);
            $this->load->view('directory');
            $this->load->view('templates/footer');
        }
        else
        {
            show_error('You must provide a search value and field to filter the directory view');
        }
    }
    
    /**
     * Shows another cadet's profile.
     */
    function profile()
    {        
        $data['title'] = 'Profile Page';

        $user = $this->ion_auth->user($this->input->post('id'))->row();

        // Looks for profile picture
        $files = scandir("./images");
        $found = false;
        foreach($files as $file)
        {
            $info = pathinfo($file);
            if($info['filename'] == $user->id)
            {
                $data['picture'] = base_url( './images/' . $info['basename']);
                $found = true;
            }
        }
        if(!$found)
        {
            $data['picture'] = base_url("images/default.jpeg");
        }
        
        $data['user'] = $user;
        
        $data['heading'] = $user->rank . " " . $user->last_name;

        $data['myprofile'] = false;
        
        $this->load->view('templates/header', $data);
        $this->load->view('cadet/profile');
        $this->load->view('templates/footer');   
    }

}
