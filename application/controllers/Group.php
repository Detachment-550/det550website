<?php

class Group extends CI_Controller{
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
     * Shows the page where admins can create/edit/delete groups.
     */
    function adminview()
    {
        if( $this->ion_auth->is_admin() )
        {
            $data['title'] = "Edit Groups";
            $data['groups'] = $this->ion_auth->groups()->result();

            $this->load->view('templates/header', $data);
            $this->load->view('admin/group');
            $this->load->view('templates/footer');
        }
        else
        {
            show_error("You must be an admin to view this page");
        }
    }

    /*
     * Retrieve group members.
     */
    function members()
    {
        $data['members'] = $this->ion_auth->users($this->input->post('group'))->result();
        $data['users'] = $this->ion_auth->users()->result();

        echo json_encode($data);
    }

    /*
     * Adds a list of members to a group.
     */
    function addmembers()
    {
        if( $this->ion_auth->is_admin() )
        {
            foreach ($this->input->post('users') as $user)
            {
                if(!$this->ion_auth->in_group($this->input->post('group'), $user))
                {
                    $this->ion_auth->add_to_group($this->input->post('group'), $user);
                }
            }
            redirect('group/adminview');
        }
        else
        {
            show_error("You must be an admin to view this page");
        }
    }

    /*
     * Removes a list of members from a group.
     */
    function removemembers()
    {
        if( $this->ion_auth->is_admin() )
        {
            foreach ($this->input->post('users') as $user)
            {
                if($this->ion_auth->in_group($this->input->post('group'), $user))
                {
                    $this->ion_auth->remove_from_group($this->input->post('group'), $user);
                }
            }
            redirect('group/adminview');
        }
        else
        {
            show_error("You must be an admin to view this page");
        }
    }

    /*
     * Deletes a given group.
     */
    function remove()
    {
        if( $this->ion_auth->is_admin() )
        {
            $this->ion_auth->delete_group($this->input->post('group'));
            redirect('group/adminview');
        }
        else
        {
            show_error("You must be an admin to remove a group");
        }
    }
}
