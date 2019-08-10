<script src='/js/modifyattendance.js'></script>
<link rel="stylesheet" type="text/css" href="/css/modifyattendance.css">

<div class="jumbotron">
    <?php echo form_open('attendance/update'); ?>
    <label for="cadet">Cadet</label>
    <select class="form-control" name="cadet" id="cadet" onchange="populate()">
        <option value="">Choose...</option>
        <?php
        foreach($users as $user)
        {
            echo '<option value="' . $user->id . '">' . $user->first_name . ' ' . $user->last_name . '</option>';
        }
        ?>
    </select><br>

    <label for="event">Event</label>
    <select class="form-control" name="event" id="event" onchange="populate()">
        <option value="">Choose...</option>
        <?php
        foreach($events as $event)
        {
            echo '<option value="' . $event['eventID'] . '">' . $event['name'] . '</option>';
        }
        ?>
    </select><br>

    <div id="hiderecord">
        <label for="record">Record</label>
        <select class="form-control" name="record" id="record" onchange="newattendance(this.value)">
            <option value="p">Present</option>
            <option value="a">Absent</option>
            <option value="e">Excused</option>
        </select><br>

        <div id="comment">
            <label for="comments">Comments</label>
            <textarea name="comments" id="comments" class="form-control"></textarea>
        </div>
    </div><br>

    <button class="btn btn-primary" type="submit" id="save">Save Changes</button>
    </form>

</div>
