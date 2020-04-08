<?php

class Wiki extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        if( !$this->ion_auth->logged_in() )
        {
	        $this->session->set_flashdata('redirect_url', current_url());
	        redirect('login/view');
        }
    } 

    /**
     * Listing of wiki pages
     */
    function view()
    {
        $data['title'] = 'Detachment Wiki';
        $data['wikis'] = Wiki_model::all();
        $data['admin'] = $this->ion_auth->is_admin();

        $this->load->view('templates/header', $data);
        $this->load->view('wikihome');
        $this->load->view('templates/footer'); 
    }

    /**
     * Adding a new wiki page
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {
            $wiki = new Wiki_model();
            $wiki->name = $this->input->post('name');
            $wiki->save();

            redirect('wiki/view');
        }
        else
        {            
            show_error("You must give the wiki a title.");
        }
    }  

    /**
     * Editing a wiki.
     */
    function edit()
    {       
        if( $this->input->post('wiki') !== null )
        {
            $data['title'] = 'Edit Detachment Wiki';
            $data['wiki'] = Wiki_model::find($this->input->post('wiki'));

            $this->load->view('templates/header', $data);
            $this->load->view('editwiki');
            $this->load->view('templates/footer'); 
        }
        else
        {
            show_error('The wiki you are trying to edit does not exist.');
        }
    } 
    
    /**
     * Saves changes made to a wiki page.
     */
    function save()
    {
        if( $this->input->post('modifiedwiki') !== null )
        {
            $wiki = Wiki_model::find($this->input->post('modifiedwiki'));
            $wiki->body = $this->input->post('savewiki');
            $wiki->save();

            $data['wikis'] = Wiki_model::all();
            $data['title'] = "Documentation";
            $data['admin'] = $this->ion_auth->is_admin();
            $this->load->view('templates/header', $data);
            $this->load->view('wikihome');
            $this->load->view('templates/footer'); 
        }
        else
        {
            show_error('The wiki you are trying to edit does not exist.');
        }
    }

    /**
     * Delete wiki page.
     */
    function remove()
    {
        $wiki = Wiki_model::find($this->input->post('wiki'));

        // check if the wiki exists before trying to delete it
        if(isset($wiki->id))
        {
            $wiki->delete();
            redirect('wiki/view');
        }
        else
        {
            show_error('The wiki you are trying to delete does not exist.');
        }
    }
    
}
