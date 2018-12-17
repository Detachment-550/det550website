<?php 
//include('./assets/inc/header.php'); 
//if ( !isset($_SESSION['login']) || !$_SESSION['login'] )
//{
//    header('Location: index.php');
//}
?>

<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="assets/css/home.css">
</head>

  <div class="jumbotron jumbotron-fluid">
    <h1 class="display-4"> Hello! </h1>
    <div class="row">
      <div class="col-4">
	    <div class="card" style="width:100%">
  		  <div class="card-header">
    		Events
  		  </div>
  		<?php 
        foreach( $events as $event )
        {
            echo "<div class=\"card-body\">";
    		echo "<h5 class=\"card-title\">" . $event['name'] . "</h5>";
    		echo "<p class=\"card-text\">" . $event['date'] . "</p>";
    		echo "<a href='attendance.php?eventid=" . $event['eventID'] . "' class=\"btn btn-sm btn-primary\">View</a></div>";
  		
        } 
            ?>
	   </div>
      </div>

    <div class="col-4">
      <div class="card" style="width:100%">
        <div class="card-header">
            Announcements
        </div>
            <?php
            foreach( $announcements as $announcement )
            {
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . $announcement['title'] . '</h5>';
                echo "<p class='card-text'> " . $announcement['subject'] . '</p>';
                echo "<p class='card-text'>" . $announcement['firstName'] . ' ' . $announcement['lastName'] . '</p></div>';
            }
            ?>
      </div>
    </div>

    <div class="col-4">
	  <div class="card" style="width:100%">
  		<div class="card-header">
    		Status
  		</div>
  		<div class="card-body">
        <h5 class="card-title">Leadership Labs</h5>
            <?php 
//                        $sql = "SELECT * FROM cadetEvent WHERE llab = 1";
//                        $stmt = $mysqli->prepare($sql);
//                        $stmt->execute();
//                        $result = $stmt->get_result();
//                        $sum = mysqli_num_rows($result);
//            
//                        $sql = "SELECT * FROM attendance, cadetEvent WHERE attendance.eventid = cadetEvent.eventID AND rin = ? AND llab = 1";
//                        $stmt = $mysqli->prepare($sql);
//                        $stmt->bind_param("i", $_SESSION['rin']);
//                        $stmt->execute();
//                        $result = $stmt->get_result();
//                        $attend = mysqli_num_rows($result);
//                            
//                        if($sum != 0)
//                        {
//                           $perc = number_format( (($attend / $sum) * 100), 2 ); 
//                        }
//                        else
//                        {
//                            $perc = 100;
//                        }       
            ?>
    		<p class="card-text">Attendance: <?php //echo $perc; ?>%</p>
        <h5 class="card-title">PT</h5>
            <?php 
//                        $sql = "SELECT * FROM cadetEvent WHERE pt = 1";
//                        $stmt = $mysqli->prepare($sql);
//                        $stmt->execute();
//                        $result = $stmt->get_result();
//                        $sum = mysqli_num_rows($result);
//            
//                        $sql = "SELECT * FROM attendance, cadetEvent WHERE attendance.eventid = cadetEvent.eventID AND rin = ? AND pt = 1";
//                        $stmt = $mysqli->prepare($sql);
//                        $stmt->bind_param("i", $_SESSION['rin']);
//                        $stmt->execute();
//                        $result = $stmt->get_result();
//                        $attend = mysqli_num_rows($result);
//                            
//                        if($sum != 0)
//                        {
//                           $perc = number_format( (($attend / $sum) * 100), 2 ); 
//                        }
//                        else
//                        {
//                            $perc = 100;
//                        }   
                         ?>
        <p class="card-text">Attendance: <?php // echo $perc; ?>%</p>
    		<a href="attendance.php" class="btn btn-sm btn-primary">View</a>
  		</div>
      </div>
    </div>
      </div></div>
