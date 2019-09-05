<?php

class User_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Gets a user by their RFID card.
     *
     * @param rfid - the number associated with a user's RPI ID card
     */
    function find_user($rfid)
    {
        $this->db->where('rfid', $rfid);
        return $this->db->get('users')->row_array();
    }

    /*
     * Gets a user by their email.
     *
     * @param email - the email associated with a user's account
     */
    function find_user_email($email)
    {
        $this->db->where('email', $email);
        return $this->db->get('users')->row_array();
    }

    /*
     * Gets all the users from the database by last name in ascending order.
     */
    function get_sorted_users()
    {
        $this->db->order_by('last_name', 'asc');
        return $this->db->get('users')->row_array();
    }
}

