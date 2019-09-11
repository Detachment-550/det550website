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
            $this->load->model('User_model');
            $this->load->model('Memo_type_model');
            $this->load->model('Memo_model');
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
        $data['memo_types'] = $this->Memo_type_model->get_all_memo_types();

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
        $data['events'] = $this->Cadetevent_model->get_all_cadetevents();
        $data['memo_types'] = $this->Memo_type_model->get_all_memo_types();

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
                        'memod_absence' => 1,
                        'comments' => $this->input->post('comments'),
                    );
                    $this->Attendance_model->update_attendance($this->input->post('cadet'),$this->input->post('event'),$params);
                }
                else
                {
                    $params = array(
                        'user' => $this->input->post('cadet'),
                        'eventid' => $this->input->post('event'),
                        'memod_absence' => 1,
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
                        'memod_absence' => 0,
                        'comments' => $this->input->post('comments'),
                    );
                    $this->Attendance_model->update_attendance($this->input->post('cadet'),$this->input->post('event'),$params);
                }
                else
                {
                    $params = array(
                        'user' => $this->input->post('cadet'),
                        'eventid' => $this->input->post('event'),
                        'memod_absence' => 0,
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
    function memo()
    {
        if ($this->Attendance_model->attendance_exists($this->input->post('cadet'), $this->input->post('event')) === 0) {
            $params = array(
                'user' => $this->input->post('cadet'),
                'eventid' => $this->input->post('event'),
                'memod_absence' => 1
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
     * Adds an attendance record for a cadet based on their RPI ID.
     */
    function scan()
    {
        if (isset($_POST) && count($_POST) > 0)
        {
            $user = $this->User_model->find_user($this->input->post('rfid')); // Finds user based on their RPI ID

            // Makes sure a given RPI ID card is associated with a user
            if ($user !== NULL)
            {
                // Checks to prevent duplicate attendance records
                if (!$this->Attendance_model->attendance_exists($user['id'], $this->input->post('event')))
                {
                    $params = array(
                        'user' => $user['id'],
                        'eventid' => $this->input->post('event'),
                    );

                    $this->Attendance_model->add_attendance($params);
                }

                redirect('cadetevent/event/' . $this->input->post('event'));
            }
            else
            {
                show_error("This RPI ID card is not associated with an account");
            }
        }
        else
        {
            show_error("You must provide an RPI ID scan to attend an event");
        }
    }

    /*
     * Manually adds a new attendance record by entering a user's email.
     */
    function add()
    {
        if (isset($_POST) && count($_POST) > 0)
        {

            $params = array(
                'user' => $this->input->post('id'),
                'eventid' => $this->input->post('event'),
            );

            $this->Attendance_model->add_attendance($params);

            redirect('cadetevent/event/' . $this->input->post('event'));

        }
        else
        {
            show_error("You must provide a user's email and an event");
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
     * Downloads the attached file to the memo.
     *
     * @param memo_id - the memo id
     */
    function download_memo_attachment($memo_id)
    {
        $memo = $this->Memo_model->get_memo($memo_id);
        $this->load->helper('download');
        force_download('./memo_attachments/' . $memo['attachment'], NULL);

        redirect('attendance/admin');
    }

    /*
     * Shows master list of attendance.
     */
    function master()
    {
        $data['title'] = "Master Attendance";
        $data['events'] = $this->Cadetevent_model->get_current_cadetevents();
        $data['memo_types'] = $this->Memo_type_model->get_all_memo_types();

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('attendance/masterattendance');
        $this->load->view('templates/footer');
    }

    /*
     * Returns all of the master attendance records
     */
    function get_master()
    {
        $data['record'] = $this->Attendance_model->get_attendance_records();
        $data['events'] = $this->Cadetevent_model->get_current_cadetevents();
        $data['weekevents'] = $this->Cadetevent_model->get_week_events();
        $data['users'] = $this->ion_auth->users()->result(); // get all users

        echo json_encode($data);
    }

    /*
     * Creates an memo.
     */
    function create_memo()
    {
        if(isset($_POST) && count($_POST) > 0)
        {
            $user = $this->ion_auth->user()->row();

            $params = array(
                'user' => $user->id,
                'event' => $this->input->post('event'),
                'memo_type' => $this->input->post('memo_type'),
                'comments' => $this->input->post('comments'),
            );

            $memo_id = $this->Memo_model->add_memo($params);

            if($this->input->post('attachment') !== NULL)
            {
                $config['upload_path']          = './memo_attachments/';
                $config['allowed_types']        = 'pdf';
                $config['max_size']             = 1000;
                $config['file_name']            = $memo_id;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('attachment'))
                {
                    $data['upload_errors'] = $this->upload->display_errors();

                    $data['title'] = 'Cadet Events';
                    $data['events'] = $this->Cadetevent_model->get_all_cadetevents();
                    $data['memo_types'] = $this->Memo_type_model->get_all_memo_types();

                    $this->load->view('templates/header', $data);
                    $this->load->view('attendance/attendance');
                    $this->load->view('templates/footer');
                }
                else
                {
                    $params = array(
                        'attachment' => $this->upload->data('file_name'),
                    );

                    $this->Memo_model->update_memo($memo_id, $params);

                    redirect('attendance/view');
                }
            }
            else
            {
                redirect('attendance/view');
            }
        }
        else
        {
            show_error("You must provide an memo type, event, and comments to create a memo memo");
        }
    }

    /*
     * Gets all of the memo's that have not been reviewed
     */
    function get_new_memos()
    {
        echo json_encode($this->Memo_model->get_new_memos());
    }

    /*
     * Gets all of the memo's that have not been reviewed
     */
    function get_all_memos()
    {
        echo json_encode($this->Memo_model->get_all_memos());
    }

    /*
     * Approves a memo based on it's id.
     *
     * @param memo_id - the memo id
     */
    function approve_memo($memo_id)
    {
        $memo = $this->Memo_model->get_memo($memo_id);

        $params = array(
            'excused_absence' => 1,
            'user' => $memo['user'],
            'eventid' => $memo['event'],
            'comments' => $memo['comments'],
        );

        $data['event_excused'] = $this->Attendance_model->add_attendance($params);
        $data['memo_approved'] = $this->Memo_model->approve_memo($memo_id);
        echo json_encode($data);
    }

    /*
     * Approves a memo based on it's id.
     *
     * @param memo_id - the memo id
     */
    function deny_memo($memo_id)
    {
        echo json_encode($this->Memo_model->deny_memo($memo_id));
    }

    /*
     * Gets a memo type based on it's id.
     *
     * @param memo_type_id - the memo types id
     */
    function get_memo_type($memo_type_id)
    {
        echo json_encode($this->Memo_type_model->get_memo_type($memo_type_id));
    }

    /*
     * Creates a memo type.
     */
    function create_memo_type()
    {
        if (isset($_POST) && count($_POST) > 0)
        {
            $params = array(
                'label' => $this->input->post('label'),
                'description' => $this->input->post('description'),
            );

            $this->Memo_type_model->add_memo_type($params);

            redirect('attendance/admin');
        }
        else
        {
            show_error("You must provide an memo type label and description to create a memo type");
        }
    }

    /*
     * Updates a memo type.
     */
    function update_memo_type()
    {
        if (isset($_POST) && count($_POST) > 0)
        {
            $params = array(
                'label' => $this->input->post('label'),
                'description' => $this->input->post('description'),
            );

            $this->Memo_type_model->update_memo_type($this->input->post('memo_type'), $params);

            redirect('attendance/admin');
        }
        else
        {
            show_error("You must provide an memo type label, description, and id to update a memo type");
        }
    }
}
