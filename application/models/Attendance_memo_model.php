<?php

class Attendance_memo_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Get attendance_memo.
     *
     * @param int $id - id of memo
     * @return int - index of memo
     */
    function get_attendance_memo($id)
    {
        $this->db->select('users.rank, users.last_name, attendance_memo.*, name');
        $this->db->where('attendance_memo_id', $id);
        $this->db->join('users', 'attendance_memo.user = id');
        $this->db->join('cadetEvent', 'attendance_memo.event = eventID');
        return $this->db->get('attendance_memo')->row_array();
    }
        
    /**
     * Get all attendance_memos
     *
     * @reuturn array - all memos
     */
    function get_all_attendance_memos()
    {
        $this->db->order_by('date_created', 'asc');
        $this->db->join('users', 'attendance_memo.user = users.id');
        $this->db->join('cadetEvent', 'eventID = attendance_memo.event');
        return $this->db->get('attendance_memo')->result_array();
    }

    /**
     * Get all un-reviewed attendance_memos
     *
     * @return array - all un-reviewed memos
     */
    function get_new_attendance_memos()
    {
        $this->db->where('approved', NULL);
        $this->db->join('users', 'attendance_memo.user = users.id');
        $this->db->join('cadetEvent', 'eventID = attendance_memo.event');
        return $this->db->get('attendance_memo')->result_array();
    }
        
    /**
     * Add new memo.
     *
     * @param memo $params - parameters for memo
     * @return int - id of created memo
     */
    function add_attendance_memo($params)
    {
        $this->db->insert('attendance_memo',$params);
        return $this->db->insert_id();
    }
    
    /**
     * Updates existing memo.
     *
     * @param int $id - id of memo to change
     * @param memo $params - updated memo parameters
     * @return memo - updated memo
     */
    function update_attendance_memo($id,$params)
    {
        $this->db->where('attendance_memo_id',$id);
        return $this->db->update('attendance_memo',$params);
    }
    
    /**
     * Deletes memo.
     *
     * @param int $id - id of memo
     * @return int - id of memo
     */
    function delete_attendance_memo($id)
    {
        return $this->db->delete('attendance_memo',array('attendance_memo_id'=>$id));
    }

    /**
     * Approves attendance memo.
     *
     * @param int $attendance_memo_id - the id of the attendance_memo
     * @return memo - approved memo
     */
    function approve_attendance_memo($attendance_memo_id)
    {
        $this->db->where('attendance_memo_id',$attendance_memo_id);
        $this->db->set('date_reviewed','CURRENT_TIMESTAMP()', FALSE);
        $this->db->set('approved',1);
        return $this->db->update('attendance_memo');
    }

    /**
     * Denies attendance memo.
     *
     * @param int $attendance_memo_id - the id of the attendance_memo
     * @return memo - denied memo
     */
    function deny_attendance_memo($attendance_memo_id)
    {
        $this->db->where('attendance_memo_id',$attendance_memo_id);
        $this->db->set('date_reviewed','CURRENT_TIMESTAMP()', FALSE);
        $this->db->set('approved',0);
        return $this->db->update('attendance_memo');
    }
}
