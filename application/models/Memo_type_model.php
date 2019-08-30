<?php

class Memo_type_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get memo_type by name
     */
    function get_memo_type($id)
    {
        return $this->db->get_where('memo_type',array('memo_type_id'=>$id))->row_array();
    }
        
    /*
     * Get all memo_type
     */
    function get_all_memo_types()
    {
        $this->db->order_by('label', 'asc');
        return $this->db->get('memo_type')->result_array();
    }
        
    /*
     * function to add new memo_type
     */
    function add_memo_type($params)
    {
        $this->db->insert('memo_type',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update memo_type
     */
    function update_memo_type($id,$params)
    {
        $this->db->where('memo_type_id',$id);
        return $this->db->update('memo_type',$params);
    }
    
    /*
     * function to delete memo_type
     */
    function delete_memo_type($id)
    {
        return $this->db->delete('memo_type',array('memo_type_id'=>$id));
    }
}
