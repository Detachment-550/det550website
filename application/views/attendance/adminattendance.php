<link href="/application/third_party/tabulator/tabulator_bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="/application/third_party/tabulator/tabulator.min.js"></script>
<script type="text/javascript" src="/application/third_party/moment/min/moment-with-locales.min.js"></script>

<div class="jumbotron jumbotron-fluid">
    <div class="shadow p-3 mb-5 bg-white rounded" style="margin: 15px;">
        <h2>Modify Attendance</h2>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="event">Delete an Event</label>
                    <form action="/index.php/cadetevent/remove" method="POST">
                        <select name="event" id="event" class="form-control" required>
                            <?php
                            foreach($events as $event)
                            {
                                echo "<option value='" . $event['eventID']."'>" . $event['name'] . " " . $event['date'] . "</option>";
                            }

                            ?>
                        </select>
                    </div>
                    <button onClick="return confirm('Are you sure you want to delete this Event?')" class="btn btn-primary" type="submit" name="devent">Delete</button>
                </form>
            </div>
        </div><br>

        <div class="card">
            <div class="card-body">
                <form action="/index.php/cadetevent/view" method="POST">
                    <div class="form-group">
                        <label for="setevent">Set Event Attendance</label>
                        <select name="event" id="setevent" class="form-control" required>
                            <?php
                            foreach( $events as $event )
                            {
                                echo "<option value='" . $event['eventID'] . "'>" . $event['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Select Event</button>
                </form>
            </div>
        </div><br>

        <div class="card">
            <div class="card-body">
                <label>Modify Attendance Records</label><br>
                <a href="/index.php/attendance/modify" class="btn btn-primary">Modify Attendance</a>
            </div>
        </div>
    </div>

    <div class="shadow p-3 mb-5 bg-white rounded" style="margin: 15px;">
        <h3>Review Attendance Memos</h3>
        <br>
        <div id="memo_table" class="table-condensed"></div>
    </div>

    <div class="shadow p-3 mb-5 bg-white rounded" style="margin: 15px;">
        <div>
            <h3 style="display: inline;">Historical Attendance Memos</h3>
            <button onclick="download_historical_table()" class="btn btn-primary" style="float: right;">Download Table</button>
        </div>
        <br>
        <div class="form-group">
            <label for="user">Select a User</label>
            <select class="form-control" name="user" onchange="filter_user(this.value)" required>
                <option value="">Choose...</option>
                <?php
                    foreach( $users as $user )
                    {
                        echo "<option value='" . $user->id . "'>" . $user->first_name . " " . $user->last_name . "</option>";
                    }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="event">Select an Event</label>
            <select class="form-control" name="event" onchange="filter_event(this.value)" required>
                <option value="">Choose...</option>
                <?php
                    foreach( $events as $event )
                    {
                        echo "<option value='" . $event['eventID'] . "'>" . $event['name'] . "</option>";
                    }
                ?>
            </select>
        </div>
        <div id="historical_memo_table" class="table-condensed"></div>
    </div>
</div>

<script type="text/javascript" src="/js/adminattendance.js"></script>
