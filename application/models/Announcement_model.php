<?php
 
class Announcement_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get announcement by uid
     */
    function get_announcement($uid)
    {
        return $this->db->get_where('announcement',array('uid'=>$uid))->row_array();
    }
    
    /*
     * Get last 5 announcements by date
     */
    function get_last_five_announcements()
    {
        $this->db->join('users', 'users.id = announcement.createdBy');
        $this->db->order_by('date', 'desc');
        $this->db->limit(5);

        $query = $this->db->get('announcement');
        return $query->result_array();
    }

    /*
     * Returns a given 5 announcements
     */
    function get_specific_announcements( $limit, $start )
    {
        $this->db->order_by('date', 'desc');
        $this->db->limit($limit, $start);

        $query = $this->db->get('announcement');
        return $query->result_array();
    }

    /*
     * Returns the total number of announcements
     */
    public function record_count()
    {
        return $this->db->count_all("announcement");
    }

    /*
     * Get all announcement
     */
    function get_all_announcements()
    {
        $this->db->order_by('date', 'desc');
        return $this->db->get('announcement')->result_array();
    }
        
    /*
     * function to add new announcement
     */
    function add_announcement($params)
    {
        $this->db->insert('announcement',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update announcement
     */
    function update_announcement($uid,$params)
    {
        $this->db->where('uid',$uid);
        return $this->db->update('announcement',$params);
    }
    
    /*
     * function to delete announcement
     */
    function delete_announcement($uid)
    {
        return $this->db->delete('announcement',array('uid'=>$uid));
    }
}
