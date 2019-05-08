<div class="jumbotron jumbotron-fluid">
    <div class="shadow p-3 mb-5 bg-white rounded" style="margin: 15px;">
        <h2>Modify Attendance</h2>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="event">Delete an Event</label>
                    <?php echo form_open('cadetevent/remove'); ?>
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
                <?php echo form_open('cadetevent/view'); ?>
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
                <?php echo anchor('attendance/modify', 'Modify Attendance', 'class="btn btn-primary"'); ?>
            </div>
        </div>
    </div>
</div>
