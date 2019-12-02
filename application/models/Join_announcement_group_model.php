<?php

class Join_announcement_group_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get a group announcement.
     *
     * @param int $id - announcement id
     * @return announcement_group_jointable - requested announcement
     */
    function get_announcement_group($id)
    {
        return $this->db->get_where('announcement_group_jointable',array('id'=>$id))->row_array();
    }

    /**
     * Get all group announcements.
     *
     * @return array - all announcements
     */
    function get_all_announcement_groups()
    {
        return $this->db->get('announcement_group_jointable')->result_array();
    }

    /**
     * Add new group announcement.
     *
     * @param announcement_group_jointable $params - announcement parameters
     * @return int - new event id
     */
    function add_announcement_group($params)
    {
        $this->db->insert('announcement_group_jointable',$params);
        return $this->db->insert_id();
    }

    /**
     * Checks to see if group announcement already exists.
     *
     * @param int $group - group id
     * @param int $announcement - announcement uid
     * @return bool - true if already exists, false otherwise
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

    /**
     * Update group announcement.
     *
     * @param int $id - announcement id
     * @param announcement_group_jointable - updated announcement parameters
     * @return int - updated announcement id
     */
    function update_announcement_group($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('announcement_group_jointable',$params);
    }

    /**
     * function to delete a group announcement
     *
     * @param int $id - announcement id
     * @return int $id - deleted announcement id
     */
    function delete_announcement_group($id)
    {
        return $this->db->delete('announcement_group_jointable',array('id'=>$id));
    }

    /**
     * Delete an announcement from a group announcement.
     *
     * @param int $announcement_id - announcement id
     * @return int - announcement id
     */
    function delete_announcement_groups($announcement_id)
    {
        return $this->db->delete('announcement_group_jointable',array('announcement'=>$announcement_id));
    }
}
