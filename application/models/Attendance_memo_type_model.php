<?php

class Attendance_memo_type_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Get the memo attendance type  by name.
     *
     * @param int $id - attendance memo type id
     * @return int - index of memo type
     */
    function get_attendance_memo_type($id)
    {
        return $this->db->get_where('attendance_memo_type',array('attendance_memo_type_id'=>$id))->row_array();
    }
        
    /**
     * Gets all of the attendance memo types.
     *
     * @return array - all attendance memos types
     */
    function get_all_attendance_memo_types()
    {
        $this->db->order_by('label', 'asc');
        return $this->db->get('attendance_memo_type')->result_array();
    }
        
    /**
     * Adds new attendance memo type
     *
     * @param memo_type $params - new memo type
     * @return int - id where the memo was added
     */
    function add_attendance_memo_type($params)
    {
        $this->db->insert('attendance_memo_type',$params);
        return $this->db->insert_id();
    }
    
    /**
     * Updates memo attendance type.
     *
     * @param int $id - desired memo type to change
     * @param memo_type $params - modified memo attendnace type
     * @return memo_type - updated memo type
     */
    function update_attendance_memo_type($id,$params)
    {
        $this->db->where('attendance_memo_type_id',$id);
        return $this->db->update('attendance_memo_type',$params);
    }
    
    /**
     * Deletes memo type.
     *
     * @param int $id - id of memo type
     * @return memo_type - deleted memo
     */
    function delete_attendance_memo_type($id)
    {
        return $this->db->delete('attendance_memo_type',array('attendance_memo_type_id'=>$id));
    }
}
