<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/attend.css"); ?>">

<body>
  <div class="jumbotron container-fluid">
	<h1 class="display-4"> Attendance </h1><br>
      <h3 class='h3'> Event: <?php echo $event["name"]; ?> </h3>

        <?php echo form_open('attendance/add'); ?>          
      Scan RPI ID Card: <input class="form-control" type="password" name="rfid" autofocus required><br>
        <input style="display:none;" type="text" name="event" value="<?php echo $event['eventID']; ?>">
          <input class="btn btn-sm btn-primary" type="submit" value="Submit">
          </form><br>
      
        <?php echo form_open('attendance/add'); ?>          
          No RFID Scanner? Enter RIN: <input class="form-control" type="text" name="rin" required><br>
            <input style="display:none;" type="text" name="event" value="<?php echo $event['eventID']; ?>">
          <input class="btn btn-sm btn-primary" type="submit" value="Submit">
          </form><br>
      
        <?php echo form_open('attendance/attendees'); ?>  
            <input style="display:none;" type="text" name="event" value="<?php echo $event['eventID']; ?>">
          <input class='btn btn-sm btn-primary' type='submit' value='Show All Atendees' name='show_attendance'/>
          </form><br>
      
      <a class='btn btn-sm btn-primary' href="<?php echo site_url("cadet/changerfid"); ?>">Add Cadet ID Card</a><br><br>
  </div>