<link rel="stylesheet" type="text/css" href="/css/attend.css">

<div class="jumbotron container-fluid">
    <h3 class='h3'> Event: <?php echo $event->name; ?> </h3>

    <form action="/index.php/attendance/scan" method="POST">
        <div class="form-group">
            <label for="rfid">Scan RPI ID Card: </label>
            <input class="form-control" id="rfid" type="password" placeholder="Select input before scanning..." name="rfid" autofocus required>
        </div>
        <input style="display:none;" type="text" name="event" value="<?php echo $event->id; ?>">
        <button class="btn btn-primary" type="submit">Scan Card</button>
    </form><br>

    <form action="/index.php/attendance/add" method="POST">
        <div class="form-group">
            <label for="email">No RFID Scanner? Select User:</label>
            <div class="form-group">
                <label for="id">Select User:</label>
                <select name="id" id="id" class="form-control" required>
                    <option value="">Choose...</option>
                    <?php
                        usort($users, create_function('$a, $b', 'return strnatcasecmp($a->last_name, $b->last_name);'));
                        foreach ($users as $user) {
                            if ($user->class != 'None') {
                                echo '<option value="' . $user->id . '">' . $user->last_name . ', ' . $user->first_name . '</option>';
                            }
                        }
                    ?>
                </select>
            </div>
        </div>

        <input style="display:none;" type="text" name="event" value="<?php echo $event->id; ?>">
        <input class="btn btn-primary" type="submit" value="Submit">
    </form>
    <br>
    <br>

    <a class='btn btn-secondary' href="/index.php/attendance/attendees/<?php echo $event->id; ?>">Show All Attendees</a>
    <a class='btn btn-warning' style="float: right;" href="/index.php/cadet/change_rfid">Add Cadet ID Card</a><br><br>
</div>
