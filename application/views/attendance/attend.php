<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/attend.css"); ?>">

<div class="jumbotron container-fluid">
    <h3 class='h3'> Event: <?php echo $event["name"]; ?> </h3>

    <?php echo form_open('attendance/scan'); ?>
    <div class="form-group">
        <label for="rfid">Scan RPI ID Card: </label>
        <input class="form-control" id="rfid" type="password" placeholder="Select input before scanning..." name="rfid" autofocus required>
    </div>
    <input style="display:none;" type="text" name="event" value="<?php echo $event['eventID']; ?>">
    <button class="btn btn-primary" type="submit">Scan Card</button>
    </form><br>

    <?php echo form_open('attendance/add'); ?>
    <div class="form-group">
        <label for="email">No RFID Scanner? Enter your Email:</label>
        <input class="form-control" id="email" type="email" placeholder="Enter your account email..." name="email" required>
    </div>

    <input style="display:none;" type="text" name="event" value="<?php echo $event['eventID']; ?>" required>
    <input class="btn btn-primary" type="submit" value="Submit">
    </form>
    <br>
    <br>

    <?php echo form_open('attendance/attendees', array('style' => 'display:inline;')); ?>
    <input style="display:none;" type="text" name="event" value="<?php echo $event['eventID']; ?>">
    <button class='btn btn-secondary' type='submit'>Show All Attendees</button>
    </form>

    <a class='btn btn-warning' style="float: right;" href="<?php echo site_url("cadet/changerfid"); ?>">Add Cadet ID Card</a><br><br>
</div>
