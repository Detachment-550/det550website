<?php
 
class Announcement_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Get announcement by id.
     *
     * @param int $uid - announcement id
     * @return int - index of announcement
     */
    function get_announcement($uid)
    {
        $this->db->join('users', 'users.id = announcement.createdBy');
        return $this->db->get_where('announcement',array('uid'=>$uid))->row_array();
    }

    /**
     * Get announcement by uid.
     *
     * @return array - all announcements made in current day
     */
    function get_todays_announcements()
    {
        $this->db->where('DAY(date)', Date('d'));
        $this->db->where('MONTH(date)', Date('m'));
        $this->db->where('YEAR(date)', Date('Y'));
        $this->db->join('users', 'users.id = announcement.createdBy');
        return $this->db->get('announcement')->result_array();
    }

    /**
     * Get 5 most recent announcements by date.
     *
     * @param user - the user making this db query
     * @return array - 5 most recent announcements
     */
    function get_last_five_announcements($user)
    {
        $this->db->select('DISTINCT(announcement.uid), announcement.*, users.*');
        $this->db->join('users', 'users.id = announcement.createdBy');
        $this->db->join('announcement_group_jointable', 'announcement.uid = announcement_group_jointable.announcement');
        $this->db->join('users_groups', 'group_id = announcement_group_jointable.group');
        $this->db->where('user_id', $user);
        $this->db->order_by('date', 'desc');
        $this->db->limit(5);

        return $this->db->get('announcement')->result_array();
    }

    /**
     * Get next announcements sorted by date created.
     *
     * @param limit - the number of announcements to return
     * @param start - what row to start at in results
     * @param user - the id of the user looking for announcements
     * @return array - next announcements
     */
    function get_specific_announcements( $limit, $start, $user )
    {
        $this->db->select('DISTINCT(announcement.uid), announcement.*, users.*');
        $this->db->join('announcement_group_jointable', 'announcement.uid = announcement_group_jointable.announcement');
        $this->db->join('users_groups', 'group_id = announcement_group_jointable.group');
        $this->db->join('users', 'users_groups.user_id = users.id');
        $this->db->where('users_groups.user_id', $user);
        $this->db->order_by('date', 'desc');
        $this->db->limit($limit, $start);

        return $this->db->get('announcement')->result_array();
    }

    /**
     * Returns the total number of announcements.
     *
     * @return int - number of announcements
     */
    public function record_count()
    {
        return $this->db->count_all("announcement");
    }

    /**
     * Get all announcements sorted by date.
     *
     * @return array - all announcements
     */
    function get_all_announcements()
    {
        $this->db->order_by('date', 'desc');
        return $this->db->get('announcement')->result_array();
    }
        
    /**
     * Adds new announcement.
     *
     * @param announcement $params - new anouncement parameters
     * @return int - id of new announcement
     */
    function add_announcement($params)
    {
        $this->db->insert('announcement',$params);
        return $this->db->insert_id();
    }
    
    /**
     * Updates an existing announcement.
     *
     * @param int $uid - announcement to edit id
     * @param announcement $params - new parameters
     * @return announcement - updated announcement
     */
    function update_announcement($uid,$params)
    {
        $this->db->where('uid',$uid);
        return $this->db->update('announcement',$params);
    }
    
    /**
     * Delete announcement.
     *
     * @param int $uid - announcement id
     * @return int - deleted announcement id
     */
    function delete_announcement($uid)
    {
        return $this->db->delete('announcement',array('uid'=>$uid));
    }
}
