<style>
/* Styles for mobile */
@media (max-width: 500px) 
{
    .col-6
    {
        flex: 100%;
        max-width: 100%;
        padding-bottom: 10px;
    }
    body
    {
        min-width: 400px;
    }
}
</style>
<body>
  <div class="jumbotron container-fluid">
  	<h1 class="display-4"> Events </h1>
  	<div class="container">
      <div class="row">
        <div class="col-6">
            <div class="card" style="margin: auto;padding: 10px;">
                <h5 class="card-title">Create an Event</h5>
                    <?php echo form_open('cadetevent/add'); ?>
                    <label for=title><b>Title: </b></label><br><input class="form-control" type="text" name="name"/><br>
                    <label for=date><b>Date: </b></label><br><input class="form-control" type="datetime-local" name="date"/><br>
                    <label for=mandatory><b>Event Type: </b></label><br>
                    <select name="type"><option value="nonpmt">Non PMT</option><option value="pt">PT</option><option value="llab">LLAB</option></select><br><br> 
                    <button class="btn btn-sm btn-primary" type="submit" value="Submit" name="eventMade">Submit</button>
  			   </form>
            </div>
          </div>
          
          <div class="col-6">
    	    <div class="card" style="margin: auto;width: 100%;padding: 10px;">
    			<h5 class="card-title"> Select Event</h5>
                <?php echo form_open('attendance/attendees'); ?>
    			<select class="form-control" name="event">
    				<?php
    				foreach($events as $event) 
                    {
                        echo '<option value="' . $event['eventID'] . '">' . $event['name'] . '</option>';
    				}
    				?>
    			</select><br>
    			<button class="btn btn-sm btn-primary" type="submit" value="submit" name="selectevent">View Attendees</button><br><br>
    			</form>

    
<?php 
// TODO: Make view attendees and export to excel functions work
                
//	if (isset($_POST["selectevent"])) {
//    echo '<br></br>';
//		$eventquery = 'SELECT name, pt, llab, date FROM cadetEvent WHERE eventID = "' . $_POST["eventSelect"] . '"';
//		$eventresult = $mysqli->query($eventquery);
//		$erow = $eventresult->fetch_assoc();
//		echo $erow['name'] . ' ' . $erow['date'];
//		if ($erow['pt'] || $erow['llab']) {
//			echo ' - MANDATORY';
//		}
//        $query = 'SELECT rin FROM attendance WHERE eventid="' . $_POST["eventSelect"] .'"';
//        $result = $mysqli->query($query);
//        echo "<table style='width:100%'><tr><th>Name</th><th>Flight</th><th>Event</th><th>Time</th></tr>";
//        while ($row = $result->fetch_assoc()) {
//            $namequery = "SELECT lastName, flight, name, time FROM cadet, cadetEvent, attendance WHERE cadet.rin=" . $row['rin'] . " AND cadetEvent.eventID = " . $_POST["eventSelect"] . " AND cadet.rin = attendance.rin";
//            $res2 = $mysqli->query($namequery);
//            $row2 = $res2->fetch_assoc();
//            echo "<tr>";
//            echo "<td>Cadet ". $row2["lastName"] . "</td>";
//            echo "<td>". $row2["flight"] . "</td>";
//            echo "<td>". $row2["name"] . "</td>";
//            echo "<td>". $row2["time"] . "</td>";
//            echo "</tr>";
//        }
//        echo "</table>"; 
//    }
//    else
//    {
//         if(isset($_POST["Export"])){  
//              $query = "SELECT firstName, lastName, flight, name, excused_absence, time FROM cadet, cadetEvent, attendance WHERE cadet.rin = attendance.rin AND attendance.eventid = cadetEvent.eventID AND attendance.eventid = " . $_POST["eventSelect"];
//        $result = $mysqli->query($query);
//             if(file_exists("assets/files/eventAttendance.csv"))
//             {
//                 unlink("assets/files/eventAttendance.csv");
//             }
//        $file = fopen("assets/files/eventAttendance.csv","w"); 
//          fputcsv($file, array('First Name', 'Last Name', 'Flight', 'Event', 'Excused', 'Time'));  
//        if($result->num_rows > 0)
//        {
//             while ($row = $result->fetch_assoc()) 
//             {
//                fputcsv($file, $row);
//             }
//        }
//       
//            
//        fclose($file);  
//        echo "<br><a class='btn btn-primary btn-sm' href='assets/files/eventAttendance.csv' download>Download Attendance File</a>";
// }
//    }
?>
                   		  </div>
      	</div>
      </div>
    </div>
</div>
</body>