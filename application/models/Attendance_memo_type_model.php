<?php

class Attendance_memo_type_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get attendance_memo_type by name
     */
    function get_attendance_memo_type($id)
    {
        return $this->db->get_where('attendance_memo_type',array('attendance_memo_type_id'=>$id))->row_array();
    }
        
    /*
     * Get all attendance_memo_type
     */
    function get_all_attendance_memo_types()
    {
        $this->db->order_by('label', 'asc');
        return $this->db->get('attendance_memo_type')->result_array();
    }
        
    /*
     * function to add new attendance_memo_type
     */
    function add_attendance_memo_type($params)
    {
        $this->db->insert('attendance_memo_type',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update attendance_memo_type
     */
    function update_attendance_memo_type($id,$params)
    {
        $this->db->where('attendance_memo_type_id',$id);
        return $this->db->update('attendance_memo_type',$params);
    }
    
    /*
     * function to delete attendance_memo_type
     */
    function delete_attendance_memo_type($id)
    {
        return $this->db->delete('attendance_memo_type',array('attendance_memo_type_id'=>$id));
    }
}
