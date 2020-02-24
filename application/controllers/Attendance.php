<?php

class Attendance extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ( !$this->ion_auth->logged_in() )
        {
            redirect('login/view');
        }
    }

    /**
     * Loads the event page.
     *
     * @param string $page
     */
    function view(string $page = 'attendance')
    {
        $data['title'] = 'Cadet Events';
        $data['events'] = Event_model::orderBy('date', 'desc')->get();
        $data['memo_types'] = Attendance_memo_type_model::all();
        $data['users'] = User_model::orderBy('last_name', 'asc')->get();

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('attendance/' . $page);
        $this->load->view('templates/footer');
    }

    /**
     * Shows the admin page to modify attendance records.
     */
    function admin()
    {
        $data['title'] = 'Modify Attendance';
        $data['events'] = Event_model::all();
        $data['users'] = $this->ion_auth->users()->result();
        $data['memo_types'] = Attendance_memo_type_model::all();

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('attendance/adminattendance');
        $this->load->view('templates/footer');
    }

    /**
     * Shows page to manually change attendance.
     */
    function modify()
    {
        $data['title'] = 'Modify Attendance';
        $data['events'] = Event_model::all();
        $data['users'] = $this->ion_auth->users()->result();

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('attendance/modifyattendance');
        $this->load->view('templates/footer');
    }

    /**
     * Get json of the event attendance.
     *
     * @param int $user_id The user id
     * @param int $event_id The event id
     */
    function status(int $user_id, int $event_id)
    {
        if(Attendance_model::where('event_id', '=', $event_id)->where('user_id', '=', $user_id)->exists())
        {
            echo Attendance_model::where('event_id', '=', $event_id)->where('user_id', '=', $user_id)->first()->toJson();
        }
        else
        {
            echo json_encode(NULL);
        }
    }

    /**
     * Updates a user's attendance record.
     */
    function update()
    {
        if (isset($_POST) && count($_POST) > 0)
        {
            $attendance_record = Attendance_model::where('user_id', '=', $this->input->post('cadet'))
                ->where('event_id', '=', $this->input->post('event'))->first();

            if($this->input->post('record') === 'a')
            {
                // Delete the cadet attendance record if it exists
                if( $attendance_record !== NULL)
                {
                    $attendance_record->delete();
                }
            }
            else if($this->input->post('record') === 'e')
            {
                if( $attendance_record !== NULL)
                {
                    $attendance_record->excused_absence = 1;
                    $attendance_record->comments = $this->input->post('comments');
                    $attendance_record->save();
                }
                else
                {
                    $attendance_record = new Attendance_model();
                    $attendance_record->excused_absence = 1;
                    $attendance_record->comments = $this->input->post('comments');
                    $attendance_record->user_id = $this->input->post('cadet');
                    $attendance_record->event_id = $this->input->post('event');
                    $attendance_record->save();
                }
            }
            else
            {
                if( $attendance_record !== NULL)
                {
                    $attendance_record->excused_absence = 0;
                    $attendance_record->comments = $this->input->post('comments');
                    $attendance_record->save();
                }
                else
                {
                    $attendance_record = new Attendance_model();
                    $attendance_record->excused_absence = 0;
                    $attendance_record->comments = $this->input->post('comments');
                    $attendance_record->user_id = $this->input->post('cadet');
                    $attendance_record->event_id = $this->input->post('event');
                    $attendance_record->save();
                }
            }

            redirect('attendance/modify');
        }
        else
        {
            show_error("You must provide a cadet, event, and status to update a cadet attendance record.");
        }
    }

    /**
     * Creates attendance memo.
     */
    function memo()
    {
        if (Attendance_model::where('user_id', '=', $this->input->post('cadet'))->where('event_id', '=', $this->input->post('event'))->exists()) {
            $attendance = new Attendance_model();
            $attendance->user_id = $this->input->post('cadet');
            $attendance->event_id = $this->input->post('event');
            $attendance->excused_absence = 1;
            $attendance->save();
        }

        $data['title'] = 'Set Attendance';
        $data['event'] = Event_model::find($this->input->post('event'));
        $data['cadets'] = User_model::orderBy('last_name','desc')->get();

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('attendance/attend');
        $this->load->view('templates/footer');
    }

    /**
     * Add attendance record via RFID Scanner.
     */
    function scan()
    {
        if (isset($_POST) && count($_POST) > 0)
        {
            // Makes sure a given RPI ID card is associated with a user
            if (User_model::where('rfid', '=', $this->input->post('rfid'))->exists())
            {
                $user = User_model::where('rfid', '=', $this->input->post('rfid'))->first(); // Finds user based on their RPI ID
                // Checks to prevent duplicate attendance records
                if (!Attendance_model::where('user_id', '=', $user->id)->where('event_id', '=', $this->input->post('event'))->exists())
                {
                    $attendance_record = new Attendance_model();
                    $attendance_record->user_id = $user->id;
                    $attendance_record->event_id = $this->input->post('event');
                    $attendance_record->save();
                }

                redirect('cadetevent/event/' . $attendance_record->event_id);
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


    /**
     * Add attendance record via dropdown menu of cadets.
     */
    function add()
    {
        if (isset($_POST) && count($_POST) > 0)
        {
            if(!Attendance_model::where('event_id', '=', $this->input->post('event'))->where('user_id', '=', $this->input->post('id'))->exists())
            {
                $attendance_record = new Attendance_model();
                $attendance_record->user_id = $this->input->post('id');
                $attendance_record->event_id = $this->input->post('event');
                $attendance_record->save();
            }

            redirect('cadetevent/event/' . $this->input->post('event'));
        }
        else
        {
            show_error("You must provide a user's email and an event");
        }
    }

    /**
     * Gets list of attendees for a given event.
     *
     * @param int $event_id The event id of the event
     */
    function attendees(int $event_id)
    {
        $data['title'] = 'Cadet Attendance';
        $data['event'] = Event_model::with('attendees.user')->find($event_id);

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('attendance/viewattendees');
        $this->load->view('templates/footer');
    }

    /**
     * Creates and downloads csv of attendance records.
     */
    function export()
    {
        $file = $this->Attendance_model->export_event_attendance($this->input->post('event'));
        force_download('attendance.csv', $file);
    }

    /**
     * Downloads attached PDF to the memo.
     *
     * @param int $memo_id The memo id
     */
    function download_memo_attachment(int $memo_id)
    {
        $memo = Attendance_memo_model::find($memo_id);
        $this->load->helper('download');
        force_download('./memo_attachments/' . $memo->attachment, NULL);

        redirect('attendance/admin');
    }

    /**
     * Shows master list of attendance.
     */
    function master()
    {
        $data['title'] = "Master Attendance";
        $data['memo_types'] = Attendance_memo_type_model::all();

        // Loads the home page
        $this->load->view('templates/header', $data);
        $this->load->view('attendance/masterattendance');
        $this->load->view('templates/footer');
    }


    /**
     * Get json data for master attendance for a given date range.
     *
     * @param string $start_date
     * @param string $end_date
     */
    function get_attendance_records(string $start_date, string $end_date)
    {
        $sql_start_date = Date('Y-m-d', strtotime($start_date));
        $sql_end_date = Date('Y-m-d', strtotime($end_date));

        $events = Event_model::whereDate('date', '>=', $sql_start_date)->whereDate('date', '<=', $sql_end_date)
            ->with('attendees.user', 'attendees.event')->get();

        // Adds a column for the name of the cadet
        $column = NULL;
        $column['title'] = 'Cadet';
        $column['field'] = 'name';
        $column['download'] = TRUE;
        $column['headerVertical'] = TRUE;
        $data['columns'][] = $column;

        // Adds a column for the AS class
        $column = NULL;
        $column['title'] = 'AS Class';
        $column['field'] = 'class';
        $column['download'] = FALSE;
        $column['headerVertical'] = TRUE;
        $column['visible'] = FALSE;
        $data['columns'][] = $column;


        // Adds columns for each event
        foreach ($events as $event) {
            $column = NULL;
            $column['title'] = $event->name;
            $column['field'] = '' . $event->id;
            $column['download'] = TRUE;
            $column['formatter'] = 'color';
            $column['headerVertical'] = TRUE;
            $data['columns'][] = $column;
        }

        // Adds a column for the PT total for a given cadet
        $column = NULL;
        $column['title'] = 'PT Total';
        $column['field'] = 'pt';
        $column['download'] = TRUE;
        $column['align'] = 'center';
        $column['headerVertical'] = FALSE;
        $data['columns'][] = $column;

        // Adds a column for the LLAB total for a given cadet
        $column = NULL;
        $column['title'] = 'LLAB Total';
        $column['field'] = 'llab';
        $column['download'] = TRUE;
        $column['align'] = 'center';
        $column['headerVertical'] = FALSE;
        $data['columns'][] = $column;

        $users = User_model::orderBy('last_name', 'asc')->get();
        $user_records = array();
        foreach ($users as $user) {
            $user_record = NULL;
            $user_record['name'] = $user->rank . ' ' . $user->last_name;
            $user_record['class'] = $user->class;

            // Gets the users attendance record for each event and stores it
            foreach ($events as $event)
            {
                $attendance = Attendance_model::whereHas('event', function ($query) use ($event, $sql_end_date, $sql_start_date) {
                    $query->where('event_id', '=', $event->id)->whereDate('date', '>=', $sql_start_date)
                        ->whereDate('date', '<=', $sql_end_date);
                })->with('event')->where('user_id', '=', $user->id)->first();

                if($attendance === NULL)
                {
                    $user_record[$event->id] = 'white';
                }
                else if($attendance->excused_absence == 1)
                {
                    $user_record[$event->id] = 'yellow';
                }
                else
                {
                    $user_record[$event->id] = 'green';
                }
            }

            $user_pt_count = Attendance_model::whereHas('event', function ($query) use ($sql_end_date, $sql_start_date) {
                $query->whereDate('date', '>=', $sql_start_date)->whereDate('date', '<=', $sql_end_date)->where('pt', '=', 1);
            })->with('event')->where('user_id', '=', $user->id)->count();

            $pt_total = Event_model::whereDate('date', '>=', $sql_start_date)->whereDate('date', '<=', $sql_end_date)
                ->where('pt', '=', 1)->count();

            $user_record['pt'] = $user_pt_count . '/' . $pt_total;

            $user_llab_count = Attendance_model::whereHas('event', function ($query) use ($sql_end_date, $sql_start_date) {
                $query->whereDate('date', '>=', $sql_start_date)->whereDate('date', '<=', $sql_end_date)->where('llab', '=', 1);
            })->with('event')->where('user_id', '=', $user->id)->count();

            $llab_total = Event_model::whereDate('date', '>=', $sql_start_date)->whereDate('date', '<=', $sql_end_date)
                ->where('llab', '=', 1)->count();

            $user_record['llab'] = $user_llab_count . '/' . $llab_total;

            array_push($user_records, $user_record);
        }

        $data['user_records'] = $user_records;

        echo json_encode($data);
    }

    /**
     * Allows user to create attendance memo.
     */
    function create_memo()
    {
        if(isset($_POST) && count($_POST) > 0)
        {
            $user = $this->ion_auth->user()->row();
            $memo = new Attendance_memo_model();
            $memo->user_id = $user->id;

            if($this->input->post('event') === '')
            {
                $memo->event_id = NULL;
            }
            else
            {
                $memo->event_id = $this->input->post('event');
            }

            $memo->attendance_memo_type_id = $this->input->post('memo_type');
            $memo->memo_for_id = $this->input->post('memo_for');
            $memo->comments = $this->input->post('comments');
            $memo->save();

            $config['upload_path']          = './memo_attachments/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 10000;
            $config['file_name']            = $memo->id;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('attachment'))
            {
                $data['upload_errors'] = $this->upload->display_errors();

                $data['title'] = 'Cadet Events';
                $data['events'] = Event_model::orderBy('date', 'desc')->get();
                $data['memo_types'] = Attendance_memo_type_model::all();
                $data['users'] = User_model::orderBy('last_name', 'asc')->get();
                $this->email_memo($memo->id);

                $this->load->view('templates/header', $data);
                $this->load->view('attendance/attendance');
                $this->load->view('templates/footer');
            }
            else
            {
                $memo->attachment = $this->upload->data('file_name');
                $memo->save();
                $this->email_memo($memo->id);

                redirect('attendance/memo_success/' . $memo->id);
            }
        }
        else
        {
            show_error("You must provide an memo type, event, and comments to create a memo memo");
        }
    }


    /**
     * Emails the memo to the user it is designated for.
     *
     * @param int $memo_id The id of the submitted memo
     *
     * @return bool
     */
    function email_memo(int $memo_id)
    {
        $memo = Attendance_memo_model::with('memo_for', 'event', 'attendance_memo_type', 'created_by')->find($memo_id);

        $message = '<h1 style="text-align: center;">Memorandum For Record</h1>
                    <br>
                    <p><strong>Submitted By:</strong> ' . $memo->memo_for->rank . ' ' . $memo->memo_for->last_name . '</p>
                    <p><strong>Event:</strong> ' . $memo->event->name . '</p>
                    <p><strong>Reason:</strong> ' . $memo->attendance_memo_type->label . '</p>
                    <p><strong>Date:</strong> ' . Date('Y-m-d H:i:s', strtotime($memo->created_at . ' -5 hours')) . '</p>
                    <p><strong>Comments:</strong></p>';

        if($memo->comments === '')
        {
            $message .= '<p>N/a</p>';
        }
        else
        {
            $message .= '<p>' . $memo->comments . '</p>';
        }

        $path = './memo_attachments/';
        $filename = $memo->id . '.pdf';
        $file = $path . "/" . $filename;

        $to = $memo->memo_for->email;
        $subject = "AFROTC Memo";
        $random_hash = md5(date('r', time()));
        $headers = "From:noreply@det550.com\r\n" .
            "X-Mailer: PHP" . phpversion() . "\r\n" .
            "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary = $random_hash\r\n\r\n";

        if(file_exists($file))
        {
            $content = file_get_contents($file);
            $content = chunk_split(base64_encode($content));

            //plain text
            $body = "--$random_hash\r\n";
            $body .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $body .= chunk_split(base64_encode($message));

            //attachment
            $body .= "--$random_hash\r\n";
            $body .="Content-Type: application/octet-stream; name=".$filename."\r\n";
            $body .="Content-Disposition: attachment; filename=".$filename."\r\n";
            $body .="Content-Transfer-Encoding: base64\r\n";
            $body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n";
            $body .= $content;

        }else{
            //plain text
            $body = "--$random_hash\r\n";
            $body .= "Content-Type: text/html; charset=utf-8\r\n"; // use different content types here
            $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
            $body .= chunk_split(base64_encode($message));
        }

        return mail($to, $subject, $body, $headers);
    }

    /**
     * Shows a success page for submitting a memo.
     *
     * @param int $memo_id The id for submitted memo
     */
    function memo_success(int $memo_id)
    {
        $data['title'] = 'Memo Submitted';
        $data['memo'] = Attendance_memo_model::with('event', 'memo_for', 'attendance_memo_type')->find($memo_id);

        $this->load->view('templates/header', $data);
        $this->load->view('attendance/memo_success');
        $this->load->view('templates/footer');
    }

    /**
     * Get json data of memos that need to be approved
     */
    function get_new_memos()
    {
        echo Attendance_memo_model::with('created_by', 'memo_for', 'event')->whereNull('approved')
            ->whereNotNull('event_id')->get()->toJson();
    }

    /**
     * Get json data of all memos.
     *
     * @param int $page What page you are viewing
     * @param int $size The size of the page you are viewing
     */
    function get_all_memos(int $page, int $size)
    {
        // What row in the database to start the search at
        $offset = intval($size) * (intval($page) - 1);

        $data['data'] = Attendance_memo_model::with('created_by', 'memo_for', 'event')
            ->orderBy('created_at', 'desc')->limit($size)->offset($offset)->get();

        // Total number of available pages
        $data['last_page'] = ceil(Attendance_memo_model::with('created_by', 'memo_for', 'event')->count() / $size);

        $data['page'] = $page;
        $data['pagination_size'] = $size;
        echo json_encode($data);
    }

    /**
     * Approves inputted memo.

     * @param int $memo_id The memo's id
     */
    function approve_memo(int $memo_id)
    {
        $memo = Attendance_memo_model::find($memo_id);
        $attendance_record = new Attendance_model();
        $attendance_record->user_id = $memo->user_id;
        $attendance_record->event_id = $memo->event_id;
        $attendance_record->comments = $memo->comments;
        $attendance_record->excused_absence = 1;
        $attendance_record->save();
        $data['memo_approved'] = TRUE;
        $data['event_excused'] = TRUE;

        echo json_encode($data);
    }

    /**
     * Denies inputted memo.
     *
     * @param int $memo_id The memo's id
     */
    function deny_memo(int $memo_id)
    {
        $memo = Attendance_memo_model::find($memo_id);
        $memo->approved = 0;
        $memo->save();
        echo $memo->toJson();
    }

    /**
     * Gets json data of a memo type
     *
     * @param int $memo_type_id The memo types id
     */
    function get_memo_type(int $memo_type_id)
    {
        echo Attendance_memo_type_model::find($memo_type_id)->toJson();
    }

    /**
     * Creates a new memo type.
     */
    function create_memo_type()
    {
        if (isset($_POST) && count($_POST) > 0)
        {
            $memo_type = new Attendance_memo_type_model();
            $memo_type->label = $this->input->post('label');
            $memo_type->description = $this->input->post('description');
            $memo_type->save();

            redirect('attendance/admin');
        }
        else
        {
            show_error("You must provide an memo type label and description to create a memo type");
        }
    }

    /**
     * Updates a memo type.
     */
    function update_memo_type()
    {
        if (isset($_POST) && count($_POST) > 0)
        {
            $memo_type = Attendance_memo_type_model::find($this->input->post('memo_type'));
            $memo_type->label = $this->input->post('label');
            $memo_type->description = $this->input->post('description');
            $memo_type->save();

            redirect('attendance/admin');
        }
        else
        {
            show_error("You must provide an memo type label, description, and id to update a memo type");
        }
    }
}
