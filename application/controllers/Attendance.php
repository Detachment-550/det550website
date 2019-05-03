<?php

class Attendance extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');

        if ( $this->ion_auth->logged_in() )
        {
            $this->load->model('Attendance_model');
            $this->load->model('Cadetevent_model');
        }
        else
        {
            redirect('login/view');
        }
    }

    /*
     * Loads a view for the event page.
     */
    function view()
    {
        $data['title'] = 'Cadet Events';
        $data['events'] = $this->Cadetevent_model->get_all_cadetevents();

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('attendance/attendance');
        $this->load->view('templates/footer');
    }

    /*
     * Shows the admin view page to modify attendance records.
     */
    function admin()
    {
        $data['title'] = 'Modify Attendance';
        $data['events'] = $this->Cadetevent_model->get_all_cadetevents();
        $data['users'] = $this->ion_auth->users()->result();

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('attendance/adminattendance');
        $this->load->view('templates/footer');
    }

    /*
     * Shows the page to manually change attendance.
     */
    function modify()
    {
        $data['title'] = 'Modify Attendance';
        $data['events'] = $this->Cadetevent_model->get_all_cadetevents();
        $data['users'] = $this->ion_auth->users()->result();

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('attendance/modifyattendance');
        $this->load->view('templates/footer');
    }

    /*
     * Returns in json the status of the event attendance.
     */
    function status()
    {
        if (isset($_POST) && count($_POST) > 0)
        {
            $data['status'] = $this->Attendance_model->get_attendance_status($this->input->post('cadet'), $this->input->post('event'));
        }
        else
        {
            $data['error'] = "You must provide the rin and event id to get the event status";
        }

        echo json_encode($data);
    }

    /*
     * Updates a cadets attendance record.
     */
    function update()
    {
        if (isset($_POST) && count($_POST) > 0)
        {
            $status = $this->Attendance_model->get_attendance_status($this->input->post('cadet'),$this->input->post('event'));

            if($this->input->post('record') === 'a')
            {
                // Delete the cadet attendance record if it exists
                if( $status !== NULL)
                {
                    $this->Attendance_model->delete_attendance($this->input->post('cadet'),$this->input->post('event'));
                }
            }
            else if($this->input->post('record') === 'e')
            {
                if( $status !== NULL)
                {
                    $params = array(
                        'excused_absence' => 1,
                        'comments' => $this->input->post('comments'),
                    );
                    $this->Attendance_model->update_attendance($this->input->post('cadet'),$this->input->post('event'),$params);
                }
                else
                {
                    $params = array(
                        'user' => $this->input->post('cadet'),
                        'eventid' => $this->input->post('event'),
                        'excused_absence' => 1,
                        'comments' => $this->input->post('comments'),
                    );
                    $this->Attendance_model->add_attendance($params);
                }
            }
            else
            {
                if( $status !== NULL)
                {
                    $params = array(
                        'excused_absence' => 0,
                        'comments' => $this->input->post('comments'),
                    );
                    $this->Attendance_model->update_attendance($this->input->post('cadet'),$this->input->post('event'),$params);
                }
                else
                {
                    $params = array(
                        'user' => $this->input->post('cadet'),
                        'eventid' => $this->input->post('event'),
                        'excused_absence' => 0,
                        'comments' => $this->input->post('comments'),
                    );
                    $this->Attendance_model->add_attendance($params);
                }
            }

            redirect('attendance/modify');
        }
        else
        {
            show_error("You must provide a cadet, event, and status to update a cadet attendance record.");
        }
    }

    /*
     * Adding a new attendance
     */
    function excuse()
    {
        if ($this->Attendance_model->attendance_exists($this->input->post('cadet'), $this->input->post('event')) === 0) {
            $params = array(
                'user' => $this->input->post('cadet'),
                'eventid' => $this->input->post('event'),
                'excused_absence' => 1
            );
            $this->Attendance_model->add_attendance($params);
        }

        $data['title'] = 'Set Attendance';
        $data['event'] = $this->Cadetevent_model->get_cadetevent($this->input->post('event'));
        $data['cadets'] = $this->Cadet_model->get_all_cadets();

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('attendance/attend');
        $this->load->view('templates/footer');
    }



    /*
     * Manually adds a new attendance record by entering a user's email.
     */
    function add()
    {
//        TODO: Fix this
        if (isset($_POST) && count($_POST) > 0) {
            $this->load->model('User_model');

            if ($this->input->post('rfid') !== null) {
                $user = $this->User_model->find_user($this->input->post('rfid')); // Finds user based on their RPI ID

                if ($user !== NULL) {
                    if ($this->Attendance_model->attendance_exists($data['cadet']['rin'], $this->input->post('event')) === 0) {
                        $params = array(
                            'rin' => $data['cadet']['rin'],
                            'eventid' => $this->input->post('event'),
                        );
                        $this->Attendance_model->add_attendance($params);
                    }
                    $data['title'] = 'Set Attendance';
                    $data['event'] = $this->Cadetevent_model->get_cadetevent($this->input->post('event'));
                    $data['cadets'] = $this->Cadet_model->get_all_cadets();

                    // Loads the home page
                    $this->load->view('templates/header', $data);
                    $this->load->view('attendance/attend');
                    $this->load->view('templates/footer');
                } else {
                    // TODO: Fix this link
                    redirect("cadet/changerfid");
                }
            } else if ($this->input->post('rin') !== null) {
                $data['cadet'] = $this->Cadet_model->get_cadet($this->input->post('rin'));
                if (isset($data['cadet']['rin'])) {
                    if (isset($_POST) && count($_POST) > 0) {
                        if ($this->Attendance_model->attendance_exists($data['cadet']['rin'], $this->input->post('event')) === 0) {
                            $params = array(
                                'rin' => $data['cadet']['rin'],
                                'eventid' => $this->input->post('event'),
                            );
                            $this->Attendance_model->add_attendance($params);
                        }
                        $data['title'] = 'Set Attendance';
                        $data['event'] = $this->Cadetevent_model->get_cadetevent($this->input->post('event'));
                        $data['cadets'] = $this->Cadet_model->get_all_cadets();

                        // Loads the home page
                        $this->load->view('templates/header', $data);
                        $this->load->view('attendance/attend');
                        $this->load->view('templates/footer');
                    } else {
                        show_error("There was no input given.");
                    }
                } else {
                    show_error("This is not a cadet. Please enter a valid RIN or create a cadet with this RIN");
                }
            }
        } else {
            show_error("There was no input given.");
        }
    }

    /*
     * Gets list of attendees for a given event.
     */
    function attendees()
    {
        if ($this->input->post('event') !== null) {
            $data['title'] = 'Cadet Attendance';
            $data['attendees'] = $this->Attendance_model->get_event_attendance($this->input->post('event'));
            $data['event'] = $this->Cadetevent_model->get_cadetevent($this->input->post('event'));

            // Loads the home page
            $this->load->view('templates/header', $data);
            $this->load->view('attendance/viewattendees');
            $this->load->view('templates/footer');
        } else {
            show_error('You must select an event to view the attendees of that event.');
        }
    }

    /*
     * Creates csv of attendance records.
     */
    function export()
    {
        $file = $this->Attendance_model->export_event_attendance($this->input->post('event'));

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download('attendance.csv', $file);
    }

    /*
     * Shows master list of attendance.
     */
    function master()
    {
        $data['title'] = "Master Attendance";

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('attendance/masterattendance');
        $this->load->view('templates/footer');
    }

    /*
     * Returns all of the master attendance records
     */
    function getmaster()
    {
        $data['record'] = $this->Attendance_model->get_attendance_records();
        $data['events'] = $this->Cadetevent_model->get_current_cadetevents();
        $data['users'] = $this->ion_auth->users()->result(); // get all users

        echo json_encode($data);
    }

    function weeklysummary()
    {
        echo "Coming Soon....";
//        $data['title'] = "Weekly Attendance Summary";
//        $table = array();
//        $table[0] = array();
//        $count = 0;
//        $month = date('m');
//        $year = date('Y');
//        $pt2 = 0;
//        $llab2 = 0;
//        // Grab last 3 events
//        foreach ($this->Cadetevent_model->get_last_x_events(3) as $event) {
//            if (($month > 6 && date("m", strtotime($event['date'])) > 6 || $month <= 6 && date("m", strtotime($event['date'])) <= 6) && (date("Y", strtotime($event['date'])) == $year)) {
//                $count += 1;
//                $table[0][] = $event['name'];
//            }
//
//
//        }
//        // Adds the sum columns for pt and llab totals
//        $table[0][] = "Weekly Total";
//        $table[0][] = "Running Total";
//        $count = 1;
//        // Goes through each event and checks to see if it's in the current semester and if the cadet was present, excused, or absent
//        foreach ($this->Cadet_model->get_all_cadets() as $cadet) {
//            // If person is not a cadet attendance is not shown
//            if (strpos($cadet['rank'], 'AS') !== false) {
//                $found = false;
//                $pt = 0;
//                $llab = 0;
//                $table[$count] = array();
//                $table[$count][0] = $cadet['lastName'];
//                foreach ($this->Cadetevent_model->get_last_x_events(3) as $event) {
//                    if (($month > 6 && date("m", strtotime($event['date'])) > 6 || $month <= 6 && date("m", strtotime($event['date'])) <= 6) && (date("Y", strtotime($event['date'])) == $year)) {
//                        $cursemester = true;
//                    } else {
//                        $cursemester = false;
//                    }
//                    // If the event didn't take place in the current semester event is not shown
//                    if ($cursemester) {
//                        foreach ($this->Attendance_model->get_all_attendance() as $attendee) {
//                            if ($attendee['rin'] === $cadet['rin'] && $event['eventID'] === $attendee['eventid']) {
//                                if ($attendee['excused_absence'] == 1) {
//                                    $table[$count][] = "E";
//                                    $found = true;
//                                    break;
//                                } else {
//                                    $table[$count][] = "P";
//                                    $found = true;
//                                    $month = date('m');
//                                    $year = date('Y');
//                                    if ($event['pt'] == 1) {
//                                        $pt += 1;
//                                    } else if ($event['llab'] == 1) {
//                                        $llab += 1;
//                                    }
//                                    break;
//                                }
//                            }
//                        }
//                    }
//                    if ($found === false && $cursemester) {
//                        $table[$count][] = "A";
//                    } else {
//                        $found = false;
//                    }
//                }
//
//                //FOR RUNNING TOTAL UGHHHHHHHHHHHHHHHHHHHH
//                foreach ($this->Cadetevent_model->get_all_cadetevents() as $event) {
//                    if (($month > 6 && date("m", strtotime($event['date'])) > 6 || $month <= 6 && date("m", strtotime($event['date'])) <= 6) && (date("Y", strtotime($event['date'])) == $year)) {
//                        $cursemester = true;
//                    } else {
//                        $cursemester = false;
//                    }
//                    // If the event didn't take place in the current semester event is not shown
//                    if ($cursemester) {
//                        foreach ($this->Attendance_model->get_all_attendance() as $attendee) {
//                            if ($attendee['rin'] === $cadet['rin'] && $event['eventID'] === $attendee['eventid']) {
//                                if ($attendee['excused_absence'] == 1) {
//                                    $found = true;
//                                    break;
//                                } else {
//                                    $found = true;
//                                    $month = date('m');
//                                    $year = date('Y');
//                                    if ($event['pt'] == 1) {
//                                        $pt2 += 1;
//                                    } else if ($event['llab'] == 1) {
//                                        $llab2 += 1;
//                                    }
//                                    break;
//                                }
//                            }
//                        }
//                    }
//                    if ($found === false && $cursemester) {
//
//                    } else {
//                        $found = false;
//                    }
//                }
//                //GRAB
//                $total = 0;
//                foreach ($this->Cadetevent_model->get_all_cadetevents() as $i){
//                    $total += 1;
//                }
//                try{
//                    $table[$count][] = number_format(((($llab + (float)$pt)/3)*100),2,'.','') . "%";
//                }
//                catch(Exception $e){
//                    $table[$count][] = $llab + $pt . "/" . '3';
//                }
//
//                try{
//                    $table[$count][] = number_format(((($llab2 + (float)$pt2)/($this->Cadetevent_model->get_event_total('llab')+$this->Cadetevent_model->get_event_total('pt')))*100),2,'.','') . "%";
//                }
//                catch(Exception $e){
//                    $table[$count][] = $llab2 + $pt2 . "/" . $this->Cadetevent_model->get_event_total('llab')+$this->Cadetevent_model->get_event_total('pt');
//                }
//                $count += 1;
//                $pt = 0;
//                $llab = 0;
//                $pt2 = 0;
//                $llab2 = 0;
//            }
//        }
//
//        $data['table'] = $table;
//
//        // Loads the home page
//        $this->load->view('templates/header', $data);
//        $this->load->view('attendance/weeklysummary');
//        $this->load->view('templates/footer');
    }

}
