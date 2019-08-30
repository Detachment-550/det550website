<?php

class Batch_email_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get batchemail by uid
     */
    function get_batchemail($uid)
    {
        return $this->db->get_where('emails',array('uid'=>$uid))->row_array();
    }

    /*
     * Get all batchemails
     */
    function get_all_batchemails()
    {
        $this->db->order_by('day', 'desc');
        return $this->db->get('emails')->result_array();
    }

    /*
     * function to add new batchemail
     */
    function add_batchemail($params)
    {
        $this->db->insert('emails',$params);
        return $this->db->insert_id();
    }

    /*
     * function to update batchemail
     */
    function update_batchemail($uid,$params)
    {
        $this->db->where('uid',$uid);
        return $this->db->update('emails',$params);
    }

    /*
     * Deletes a batch email based off it's uid
     *
     * @param uid - a batch email's ID
     */
    function delete_batchemail($uid)
    {
        return $this->db->delete('emails',array('uid'=>$uid));
    }

    /*
     * Searches for a cadet's daily email.
     *
     * @param id - the user's uid
     */
    function email_exists($id)
    {
        $this->db->where('user', $id);
        return $this->db->get('emails', 1)->row_array();
    }
}

