<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="../../../css/home.css">
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
        echo form_open('attendance/attendees');      
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $event['name'] . "</h5>";
        echo "<p class='card-text'>" . $event['date'] . "</p>";
        echo "<input type='text' name='event' value '" . $event['eventID'] . "' style='display:none;'>";
        echo "<button type='submit' class='btn btn-sm btn-primary'>View</button></div></form>";

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
                    <a href="/index.php/attendance/view" class="btn btn-sm btn-primary">View</a>
                </div>
            </div>
        </div>
    </div>
</div>
