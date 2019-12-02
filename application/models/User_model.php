<?php

class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Gets a user by their RFID card.
     *
     * @param int $rfid - rfid obtained from scanning RPI ID card
     * @return users - found user
     */
    function find_user($rfid)
    {
        $this->db->where('rfid', $rfid);
        return $this->db->get('users')->row_array();
    }

    /**
     * Gets a user by their email.
     *
     * @param string $email - the email associated with a user's account
     * @return users - found user
     */
    function find_user_email($email)
    {
        $this->db->where('email', $email);
        return $this->db->get('users')->row_array();
    }

    /**
     * Get all users from the database by last name in ascending order.
     *
     * @return array - all users sorted by last name
     */
    function get_sorted_users()
    {
        $this->db->order_by('last_name', 'asc');
        return $this->db->get('users')->row_array();
    }
}

