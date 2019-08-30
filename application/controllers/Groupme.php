<?php

class Groupme extends CI_Controller{
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
     * Saves cadets GroupMe access token to their profile
     */
    function auth()
    {
        $params = array(
            'groupme' => $this->input->get('access_token')
        );

        $user = $this->ion_auth->user()->row(); // Gets the logged in user

        $this->ion_auth->update($user->id, $params);

        redirect('cadet/edit');
    }

}
