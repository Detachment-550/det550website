<?php

class Acknowledge_post_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Get acknowledge_post by it's ID.
     *
     * @param int $id - the id of the post
     * @return int - index of post
     */
    function get_acknowledge_post($id)
    {
        return $this->db->get_where('acknowledge_posts',array('acknowledge_posts_id'=>$id))->row_array();
    }
    
    /**
     * Checks to see if acknowledgement exists.
     *
     * @param int $user - the id of the user
     * @param int $id - the id of the announcement
     * @return bool - if post exists
     */
    function acknowledge_post_exists($user, $id)
    {
        $this->db->from('acknowledge_posts');
        $this->db->where('user',$user);
        $this->db->where('announcement_id',$id);
        return $this->db->count_all_results();
    }
        
    /**
     * Get all acknowledge_posts.
     *
     * @return array - all acknowledge_posts
     */
    function get_all_acknowledge_posts()
    {
        $this->db->order_by('user', 'desc');
        return $this->db->get('acknowledge_posts')->result_array();
    }
    
    /**
     * Get all acknowledge_posts of a given event.
     *
     * @param int $id - event id
     * @return array - all acknowledge_posts
     */
    function get_event_acknowledge_posts($id)
    {
        $this->db->order_by('user', 'desc');
        return $this->db->get_where('acknowledge_posts',array('announcement_id'=>$id))->result_array();
    }
        
    /**
     * Add new acknowledge_post.
     *
     * @param acknowledge_post $params - parameters of new acknowledge_post
     * @return int - id of created post
     */
    function add_acknowledge_post($params)
    {
        $this->db->insert('acknowledge_posts',$params);
        return $this->db->insert_id();
    }
    
    /**
     * Updates pre-existing acknowledge_post.
     *
     * @param int $rin - rin of acknowledge post
     * @param acknowledge_post $params - updated post parameters
     * @return acknowledge_post - updated acknowledge_post
     */
    function update_acknowledge_post($rin,$params)
    {
        $this->db->where('rin',$rin);
        return $this->db->update('acknowledge_posts',$params);
    }
    
    /**
     * Delete acknowledge_post.
     *
     * @param int $rin - rin of acknowledge post
     * @return acknowledge_post - deleted post
     */
    function delete_acknowledge_post($rin)
    {
        return $this->db->delete('acknowledge_posts',array('rin'=>$rin));
    }
}
