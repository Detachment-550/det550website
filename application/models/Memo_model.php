<?php

class Memo_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get memo by name
     */
    function get_memo($id)
    {
        return $this->db->get_where('memo',array('memo_id'=>$id))->row_array();
    }
        
    /*
     * Get all memo
     */
    function get_all_memos()
    {
        $this->db->order_by('label', 'asc');
        return $this->db->get('memo')->result_array();
    }

    /*
     * Get all new memos
     */
    function get_new_memos()
    {
        $this->db->where('approved', NULL);
        $this->db->join('users', 'memo.user = users.id');
        $this->db->join('cadetEvent', 'eventID = memo.event');
        return $this->db->get('memo')->result_array();
    }
        
    /*
     * function to add new memo
     */
    function add_memo($params)
    {
        $this->db->insert('memo',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update memo
     */
    function update_memo($id,$params)
    {
        $this->db->where('memo_id',$id);
        return $this->db->update('memo',$params);
    }
    
    /*
     * function to delete memo
     */
    function delete_memo($id)
    {
        return $this->db->delete('memo',array('memo_id'=>$id));
    }

    /*
     * Sets a memo to approved.
     *
     * @param memo_id - the id of the memo
     */
    function approve_memo($memo_id)
    {
        $this->db->where('memo_id',$memo_id);
        $this->db->set('date_reviewed','CURRENT_TIMESTAMP()', FALSE);
        $this->db->set('approved',1);
        return $this->db->update('memo');
    }

    /*
     * Sets a memo to denied.
     *
     * @param memo_id - the id of the memo
     */
    function deny_memo($memo_id)
    {
        $this->db->where('memo_id',$memo_id);
        $this->db->set('date_reviewed','CURRENT_TIMESTAMP()', FALSE);
        $this->db->set('approved',0);
        return $this->db->update('memo');
    }
}
