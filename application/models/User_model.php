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
}

