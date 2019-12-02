<?php

class Alumni_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get alumni from table.
     *
     * @param int $id - alumni id
     * @return int - index of alumni on table
     */
    function get_alumni($id)
    {
        return $this->db->get_where('alumni',array('alumni_id'=>$id))->row_array();
    }

    /**
     * Get all alumni.
     *
     * @return array - alumni array
     */
    function get_all_alumni()
    {
        return $this->db->get('alumni')->result_array();
    }

    /**
     * Add new alumni.
     *
     * @param alumni $params - new alumni parameters
     * @return int - id of newly added alumni
     */
    function add_alumni($params)
    {
        $this->db->insert('alumni',$params);
        return $this->db->insert_id();
    }

    /**
     * Updates alumni.
     *
     * @param int $id - id of alumni
     * @param alumni $params - new alumni parameters
     * @return alumni - new alumni
     */
    function update_alumni($id,$params)
    {
        $this->db->where('alumni_id',$id);
        $this->db->set('last_updated', 'NOW()', FALSE);
        return $this->db->update('alumni',$params);
    }

    /**
     * Deletes alumni.
     *
     * @param int $id - id of alumni
     * @return alumni - deleted alumni
     */
    function delete_alumni($id)
    {
        return $this->db->delete('alumni',array('alumni_id'=>$id));
    }
}
