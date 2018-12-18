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
    		<p class="card-text">Attendance: <?php echo $llabperc; ?>%</p>
        <h5 class="card-title">PT</h5>
        <p class="card-text">Attendance: <?php echo $ptperc; ?>%</p>
    		<a href="attendance.php" class="btn btn-sm btn-primary">View</a>
  		</div>
      </div>
    </div>
      </div></div>
