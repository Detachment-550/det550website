<div class="jumbotron jumbotron-fluid">
    <div class="shadow p-3 mb-5 bg-white rounded" style="margin: 15px;">
        <h2>Modify Attendance</h2>
        <div class="card">
            <div class="card-body">
                <h6>Delete an Event</h6>
                <?php echo form_open('cadetevent/remove'); ?>
                <select name="event">
                    <?php
                    foreach($events as $event)
                    {
                        echo "<option value='" . $event['eventID']."'>" . $event['name'] . " " . $event['date'] . "</option>";
                    }

                    ?>
                </select><br><br>
                <button onClick="return confirm('Are you sure you want to delete this Event?')" class="btn btn-sm btn-primary" type="submit" name="devent">Delete</button>
                </form>
            </div>
        </div><br>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Set Event Attendance</h5>
                <?php echo form_open('cadetevent/view'); ?>
                <select name="event">
                    <?php
                    foreach( $events as $event )
                    {
                        echo "<option value='" . $event['eventID'] . "'>" . $event['name'] . "</option>";
                    }
                    ?>
                </select><br><br>
                <button class="btn btn-sm btn-primary" type="submit">Select Event</button>
                </form>
            </div>
        </div><br>

        <div class="card">
            <div class="card-body">
                <h6>Modify Attendance Records</h6>
                <?php echo anchor('attendance/modify', 'Modify Attendance', 'class="btn btn-sm btn-primary"'); ?>
            </div>
        </div>
    </div>
</div>
