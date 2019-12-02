<?php

class Attendance_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * Get attendance for a user.
     *
     * @param int $user - id of user
     * @return array - attendance for user
     */
    function get_attendance( $user )
    {
        $this->db->select('cadetEvent.pt, cadetEvent.llab, users.last_name, cadetEvent.name, attendance.excused_absence, attendance.time');
        $this->db->from('attendance');
        $this->db->join('users', 'users.id = attendance.user');
        $this->db->join('cadetEvent', 'cadetEvent.eventID = attendance.eventid');
        $this->db->where('attendance.user', $user);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get attendance status of a user for an event.
     *
     * @param int $user - user id
     * @param int $id - event id
     * @return int - index of user in attendance table
     */
    function get_attendance_status($user, $id)
    {
        $this->db->where('user',$user);
        $this->db->where('eventid',$id);

        return $this->db->get('attendance')->row_array();
    }

    /**
     * Returns master attendance.
     *
     * @return array - master attendance
     */
    function get_attendance_records()
    {
        $this->db->select('pt, llab, users.id, last_name, first_name, excused_absence, attendance.eventid, cadetEvent.eventID, users.username');
        $this->db->join('attendance', 'users.id = attendance.user');
        $this->db->join('cadetEvent', 'cadetEvent.eventID = attendance.eventid');
        $this->db->where('YEAR(cadetEvent.date) = YEAR(CURDATE())');

        if(date("m") >= 1 && date("m") < 6)
        {
            $this->db->where('MONTH(date) > 0');
            $this->db->where('MONTH(date) < 6');
        }
        else
        {
            $this->db->where('MONTH(date) > 5');
            $this->db->where('MONTH(date) < 13');
        }

        return $this->db->get('users')->result_array();
    }
      
    /**
     * Get attendance by event.
     *
     * @param int @id - event id
     * @return array - attendance for event
     */
    function get_event_attendance( $id )
    {
        $this->db->from('attendance');
        $this->db->join('users', 'users.id = attendance.user');
        $this->db->join('cadetEvent', 'cadetEvent.eventID = attendance.eventid');
        $this->db->where('attendance.eventid', $id);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Exports attendance of a specific event as csv.
     *
     * @param int $id - id of event
     * @return  file - csv final of attendance
     */
    function export_event_attendance( $id )
    {
        $this->db->select('users.last_name as Last Name, cadetEvent.name as Event, attendance.excused_absence as Excused, attendance.time as Time');
        $this->db->join('users', 'users.id = attendance.user');
        $this->db->join('cadetEvent', 'cadetEvent.eventID = attendance.eventid');
        $this->db->where('attendance.eventid', $id);

        $query = $this->db->get('attendance');
        $this->load->dbutil();
        $file = $this->dbutil->csv_from_result( $query );
        return $file;
    }

    /**
     * Gets totals of pt or llab in the current year for a cadet.
     *
     * @param cadetevent $event - either pt or llab
     * @param int $user - the id of the user to count for
     * @return int - resulting llab and pt totals
     */
    function get_event_total($event, $user)
    {
        $this->db->from('attendance');
        $this->db->where($event, 1);
        $this->db->where('user', $user);
        $this->db->join('cadetEvent', 'cadetEvent.eventID = attendance.eventid');
        $this->db->where('YEAR(date) = YEAR(CURDATE())');
        if(date("m") >= 1 && date("m") < 6)
        {
            $this->db->where('MONTH(date) > 0');
            $this->db->where('date <= ' . Date('Ymd'));
            $query = $this->db->where('MONTH(date) < 6');
        }
        else
        {
            $this->db->where('MONTH(date) > 5');
            $this->db->where('date <= ' . Date('Ymd'));
            $query = $this->db->where('MONTH(date) < 13');
        }

        return $query->count_all_results();
    }

    /**
     * Get all attendance records.
     *
     * @return array - all attendance records
     */
    function get_all_attendance()
    {
        $this->db->order_by('user', 'desc');
        return $this->db->get('attendance')->result_array();
    }
        
    /**
     * Add new attendance record.
     *
     * @param attendance $params - parameters for added attendance
     * @return int - id of new record
     */
    function add_attendance($params)
    {
        $this->db->insert('attendance',$params);
        return $this->db->insert_id();
    }

    /**
     * Checks whether or not an attendance record already exists.
     *
     * @param int $user - the id of a user
     * @param int $id - the event uid
     * @return bool - true if record exists false if not
     */
    function attendance_exists($user,$id)
    {
        $this->db->where('user',$user);
        $this->db->where('eventid',$id);
        $rows = $this->db->get('attendance')->num_rows();

        if($rows > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * Updates attendance record.
     *
     * @param int $user - user id
     * @param int $id - event id
     * @param attendance $params - updated attendance record
     * @return attendance - updated attendance record
     */
    function update_attendance($user,$id,$params)
    {
        $this->db->where('user',$user);
        $this->db->where('eventid',$id);
        return $this->db->update('attendance',$params);
    }
    
    /**
     * Delete attendance record.
     *
     * @param int $user - user id
     * @param int $event - event id
     * @return attendance - deleted attendance record
     */
    function delete_attendance($user,$event)
    {
        return $this->db->delete('attendance',array('user'=>$user,'eventid'=>$event));
    }
}
