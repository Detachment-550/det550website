<?php

class Join_announcement_group_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get announcement_group by name
     */
    function get_announcement_group($id)
    {
        return $this->db->get_where('announcement_group_jointable',array('id'=>$id))->row_array();
    }

    /*
     * Get all announcement_group
     */
    function get_all_announcement_groups()
    {
        return $this->db->get('announcement_group_jointable')->result_array();
    }

    /*
     * function to add new wiki
     */
    function add_announcement_group($params)
    {
        $this->db->insert('announcement_group_jointable',$params);
        return $this->db->insert_id();
    }

    /*
     * Checks to see if announcement group exists.
     *
     * @param group - the group id
     * @param announcement - the announcement uid
     */
    function exists($group, $announcement)
    {
        $this->db->where('group',$group);
        $this->db->where('announcement',$announcement);
        $rows =  $this->db->get('announcement_group_jointable')->num_rows();

        if($rows > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /*
     * function to update announcement_groups
     */
    function update_announcement_group($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('announcement_group_jointable',$params);
    }

    /*
     * function to delete announcement_groups
     */
    function delete_announcement_group($id)
    {
        return $this->db->delete('announcement_group_jointable',array('id'=>$id));
    }
}
