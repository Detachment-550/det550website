<?php

class Attendance_memo_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get attendance_memo by name
     */
    function get_attendance_memo($id)
    {
        $this->db->select('users.rank, users.last_name, attendance_memo.*, name');
        $this->db->where('attendance_memo_id', $id);
        $this->db->join('users', 'attendance_memo.user = id');
        $this->db->join('cadetEvent', 'attendance_memo.event = eventID');
        return $this->db->get('attendance_memo')->row_array();
    }
        
    /*
     * Get all attendance_memo
     */
    function get_all_attendance_memos()
    {
        $this->db->order_by('date_created', 'asc');
        $this->db->join('users', 'attendance_memo.user = users.id');
        $this->db->join('cadetEvent', 'eventID = attendance_memo.event');
        return $this->db->get('attendance_memo')->result_array();
    }

    /*
     * Get all new attendance_memos
     */
    function get_new_attendance_memos()
    {
        $this->db->where('approved', NULL);
        $this->db->join('users', 'attendance_memo.user = users.id');
        $this->db->join('cadetEvent', 'eventID = attendance_memo.event');
        return $this->db->get('attendance_memo')->result_array();
    }
        
    /*
     * function to add new attendance_memo
     */
    function add_attendance_memo($params)
    {
        $this->db->insert('attendance_memo',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update attendance_memo
     */
    function update_attendance_memo($id,$params)
    {
        $this->db->where('attendance_memo_id',$id);
        return $this->db->update('attendance_memo',$params);
    }
    
    /*
     * function to delete attendance_memo
     */
    function delete_attendance_memo($id)
    {
        return $this->db->delete('attendance_memo',array('attendance_memo_id'=>$id));
    }

    /*
     * Sets a attendance_memo to approved.
     *
     * @param attendance_memo_id - the id of the attendance_memo
     */
    function approve_attendance_memo($attendance_memo_id)
    {
        $this->db->where('attendance_memo_id',$attendance_memo_id);
        $this->db->set('date_reviewed','CURRENT_TIMESTAMP()', FALSE);
        $this->db->set('approved',1);
        return $this->db->update('attendance_memo');
    }

    /*
     * Sets a attendance_memo to denied.
     *
     * @param attendance_memo_id - the id of the attendance_memo
     */
    function deny_attendance_memo($attendance_memo_id)
    {
        $this->db->where('attendance_memo_id',$attendance_memo_id);
        $this->db->set('date_reviewed','CURRENT_TIMESTAMP()', FALSE);
        $this->db->set('approved',0);
        return $this->db->update('attendance_memo');
    }
}
