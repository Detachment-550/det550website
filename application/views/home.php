<link rel="stylesheet" type="text/css" href="/css/home.css">

<!-- Creates the status bar for LLAB and PT percentages -->
<style>
    #llabpercent
    {
        background-color: <?php
            if( $llabperc > 80 )
            {
                echo "lightgreen";
            }
            else 
            {
                echo "red";
            }
            ?>;
        width: <?php echo $llabperc; ?>%;
    }

    #ptpercent
    {
        background-color: <?php
            if( $ptperc > 80 )
            {
                echo "lightgreen";
            }
            else 
            {
                echo "red";
            }
            ?>;       
        width: <?php echo $ptperc; ?>%;
    }
</style>


<div class="jumbotron jumbotron-fluid">
    <h1 class="display-4">
        <?php echo $greeting; ?>
    </h1>
    <div class="row">
        <div class="col-4">
            <div class="card" style="width:100%">
                <div class="card-header">
    		      Events
                </div>
<?php 
    foreach( $events as $event )
    {
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $event['name'] . "</h5>";
        echo "<p class='card-text'>Date: " . Date('d M Y h:i', strtotime($event['date'])) . "</p>";
        echo "<a href='/index.php/attendance/attendees/" . $event['eventID'] . "' class='btn btn-sm btn-primary'>View Attendees</a></div>";

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
        echo "<h5 class='card-title'><a href='" . site_url('announcement/page/' . $announcement['uid']) . "'>" . $announcement['title'] . "</a></h5>";
        echo "<p class='card-text'> " . $announcement['subject'] . '</p>';
        echo "<p>Date Posted: " . Date('d M Y h:i', strtotime($announcement['date'])) . "</p>";
        echo "<p class='card-text'>Posted By: " . $announcement['first_name'] . ' ' . $announcement['last_name'] . '</p></div>';
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
                    <div id="llabprogress"><div id="llabpercent"></div></div>
                    <p class="card-text">Attendance: <?php echo $llabperc; ?>%</p>
                    <h5 class="card-title">PT</h5>
                    <div id="ptprogress"><div id="ptpercent"></div></div>
                    <p class="card-text">Attendance: <?php echo $ptperc; ?>%</p>
                    <a href="/index.php/attendance/master" class="btn btn-sm btn-primary">View</a>
                </div>
            </div>
        </div>
    </div>
</div>
