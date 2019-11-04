<link rel="stylesheet" type="text/css" href="/css/attendance.css">

<div class="jumbotron container-fluid">
    <div class="shadow p-3 mb-5 bg-white rounded" style="margin: 5px;">
        <h1>View Event Attendees</h1>
        <label for="event">Select Event</label>
        <form action="/index.php/attendance/attendees" method="POST">
            <select class="form-control" name="event" id="event" required>
                <option value="">Choose...</option>
                <?php
                    usort($events, create_function('$a, $b', 'return strnatcasecmp($a->date, $b->name);'));
                    foreach($events as $event)
                    {
                        echo '<option value="' . $event['eventID'] . '">' . $event['name'] . '</option>';
                    }
                ?>
            </select>
            <br>
            <button class="btn btn-sm btn-primary" type="submit" value="submit" name="selectevent">View Attendees</button>
        </form>
    </div>

    <div class="shadow p-3 mb-5 bg-white rounded" style="margin: 5px;">
        <h1>Submit Memo</h1>
        <form action="/index.php/attendance/create_memo" enctype="multipart/form-data" method="POST">
            <?php
                if(isset($upload_errors))
                {
                    echo '<div class="alert alert-warning" role="alert">';
                    echo $upload_errors;
                    echo '</div>';
                }
            ?>
            <div class="form-group">
                <label for="event">Select Event</label>
                <select id="event" name="event" class="form-control" required>
                    <option value="">Choose...</option>
                    <?php
                        foreach ($events as $event) {
                            echo '<option value="' . $event["eventID"] . '">' . $event["name"] . '</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="memo_type">Memo Reason</label>
                <select id="memo_type" name="memo_type" class="form-control" required>
                    <option value="">Choose...</option>
                    <?php
                        foreach ($memo_types as $memo_type) {
                            echo '<option value="' . $memo_type["memo_type_id"] . '">' . $memo_type["label"] . '</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="memo_for">Submit Memo To</label>
                <select class="form-control" name="memo_for" id="memo_for" required>
                    <option value="">Choose...</option>
                    <?php
                        foreach( $users as $user )
                        {
                            if($user->rank === 'Cadet')
                            {
                                echo "<option value='" . $user->id . "'>Cadet " . $user->last_name . "</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="attachment">Memo Attachment (PDF Only)</label>
                <input type="file" class="form-control" name="attachment" id="attachment" required/>
            </div>
            <div class="form-group">
                <label for="comments">Additional Comments</label>
                <textarea id="comments" name="comments" class="form-control" rows="5" placeholder="This is optional..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Memo</button>
        </form>
    </div>
</div>