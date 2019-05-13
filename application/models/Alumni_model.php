<?php

class Alumni_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get alumni by name
     */
    function get_alumni($id)
    {
        return $this->db->get_where('alumni',array('id'=>$id))->row_array();
    }

    /*
     * Get all alumni
     */
    function get_all_alumni()
    {
        return $this->db->get('alumni')->result_array();
    }

    /*
     * function to add new alumni
     */
    function add_alumni($params)
    {
        $this->db->insert('alumni',$params);
        return $this->db->insert_id();
    }

    /*
     * function to update alumni
     */
    function update_alumni($id,$params)
    {
        return $this->db->update('alumni',$params);
    }

    /*
     * function to delete alumni
     */
    function delete_alumni($id)
    {
        return $this->db->delete('alumni',array('id'=>$id));
    }
}
