    <div class="shadow p-3 mb-5 bg-white rounded" style="margin: 15px;">
        <h2>Create an Event</h2>
        <form action="/index.php/cadetevent/add" method="POST">
            <div class="form-group">
                <label for=title><b>Title: </b></label>
                <input class="form-control" id="title" type="text" name="name" placeholder="Enter the event name here..." required/>
            </div>

            <div class="form-group">
                <label for=date><b>Date: </b></label>
                <input class="form-control" id="date" type="datetime-local" name="date" required/>
            </div>

            <div class="form-group">
                <label for=mandatory><b>Event Type: </b></label>
                <select name="type" id="mandatory" class="form-control" required>
                    <option value="">Choose...</option>
                    <option value="nonpmt">Non PMT</option>
                    <option value="pt">PT</option>
                    <option value="llab">LLAB</option>
                </select>
            </div>
            <button class="btn btn-primary" type="submit" value="Submit" name="eventMade">Submit</button>
        </form>
    </div>

    <div class="shadow p-3 mb-5 bg-white rounded" style="margin: 15px;">
        <h2>Modify Attendance</h2>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="event">Delete an Event</label>
                    <form action="/index.php/cadetevent/remove" method="POST">
                        <select name="event" id="event" class="form-control bootstrap-select" data-live-search="true" required>
                            <option value="">Choose...</option>
                            <?php
                                foreach($events as $event)
                                {
                                    echo "<option value='" . $event->id . "'>" . $event->name . " - " . Date('m/d/Y H:i', strtotime($event->date)) . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <button onClick="return confirm('Are you sure you want to delete this Event?')" class="btn btn-danger" type="submit" name="devent">Delete</button>
                </form>
            </div>
        </div><br>

        <div class="card">
            <div class="card-body">
                <form action="/index.php/cadetevent/view" method="POST">
                    <div class="form-group">
                        <label for="setevent">Set Event Attendance</label>
                        <select name="event" id="setevent" class="form-control bootstrap-select" data-live-search="true" required>
                            <option value="">Choose...</option>
                            <?php
                                foreach( $events as $event )
                                {
                                    echo "<option value='" . $event->id . "'>" . $event->name . " - " . Date('m/d/Y H:i', strtotime($event->date)) . "</option>";
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
            <select class="form-control bootstrap-select" data-live-search="true" name="user" onchange="set_filters()" id="historical_user" required>
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
            <select class="form-control bootstrap-select" data-live-search="true" name="event" onchange="set_filters()" id="historical_event" required>
                <option value="">Choose...</option>
                <?php
                    foreach( $events as $event )
                    {
                        echo "<option value='" . $event->id . "'>" . $event->name . " - " . Date('m/d/Y H:i', strtotime($event->date)) . "</option>";
                    }
                ?>
            </select>
        </div>
        <div id="historical_memo_table" class="table-condensed"></div>
    </div>

    <div class="shadow p-3 mb-5 bg-white rounded" style="margin: 15px;">
        <h3>Create a Memo Type</h3>
        <form action="/index.php/attendance/create_memo_type" method="POST">
            <!--                TODO: Add a unique label check to this field-->
            <div class="form-group">
                <label for="label">Label</label>
                <input class="form-control" id="label" type="text" name="label" placeholder="Enter the title of this memo type..." required/>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="7" name="description" placeholder="Enter a description of this memo type..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Memo Type</button>
        </form>
        <br>

        <h3>Edit a Memo Type</h3>
        <form action="/index.php/attendance/update_memo_type" method="POST">
            <div class="form-group">
                <label for="memo_type">Select Memo Type</label>
                <select class="form-control" name="memo_type" id="memo_type" onchange="get_memo_type(this.value)" required>
                    <option value="">Choose...</option>
                    <?php
                        foreach( $memo_types as $memo_type )
                        {
                            echo "<option value='" . $memo_type->id . "'>" . $memo_type->label . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div id="hide_edit" style="display: none;">
<!--                TODO: Add a unique label check to this field-->
                <div class="form-group">
                    <label for="edit_label">Label</label>
                    <input class="form-control" id="edit_label" type="text" name="label" required/>
                </div>
                <div class="form-group">
                    <label for="edit_description">Description</label>
                    <textarea class="form-control" id="edit_description" rows="7" name="description" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Memo Type</button>
            </div>
        </form>
    </div>

<script type="text/javascript" src="/js/adminattendance.js"></script>
