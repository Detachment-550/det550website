<body>
  <div class="jumbotron container-fluid">
	<h1 class="display-4"> Announcements </h1><br>
	<a class="btn btn-primary" role="button" href="makepost.php">Make an Announcement</a><br><br>
    <div class='card'>
<?php
	foreach($announcements as $announcement) 
    {
		//print out the information for the post
		echo "<div class='card-header'>" . $announcement['title'] . "</div>";
		echo "<div class='card-body'><h5 class='card-title'>" . $announcement['subject'] . "</h5>";
        echo $announcement['body'];
		
        // TODO: Set up acknowledge posts feature
//		if (isset($_POST[$announcement['uid']])) {
//			$insertquery = 'INSERT INTO acknowledge_posts (`rin`, `announcement_id`) VALUES (?,?)';
//			$statement = $mysqli->prepare($insertquery);
//			$statement->bind_param("ii",$_SESSION['rin'],$row['uid']);
//			$statement->execute();
//			$statement->close();
//		}

		// Prints out the author of the post
        foreach($cadets as $cadet)
        {   
            if($cadet['rin'] === $announcement['createdBy'])
            {
                $firstName = $cadet['firstName'];
                $lastName = $cadet['lastName'];
            }
        }
		echo "<p class='card-text'>Posted by: " . $firstName . ' ' . $lastName . "</p>";

        // TODO: Fix it so duplicate clicks isn't an issue
		// Make a button to read and understand post
		echo '<form class="acknowledge" action="/index.php/acknowledge_post/add" method="post">';
        echo "<input type='text' value='" . $announcement['uid'] . "' style='display:none;' name='announcementid'/>";
		echo '<button class="btn btn-sm btn-primary" type="submit" name="' . $announcement['uid'] . '">Read and Understood</button></form>';
        
        // Count of people who have read post
        $count = 0;
        foreach( $ackposts as $ackpost )
        {
            if( $ackpost['announcement_id'] === $announcement['uid'] )
            {
                $count += 1;
            }
        }
        
		// Print out the number of people that have read and understood the post
		// When it is clicked it prints out the list of people that have
		echo '<form action="announcements.php" method="post">';
		echo '<input type="submit" name="' . $announcement['uid'] . 'second' . '" value="'. $count .'"/></form>';

        // TODO: Make it work so you can see who acknowledged the post
//		$setstr = $announcement['uid'] . 'second';
//		if (isset($_POST[$setstr])) 
//        {
//			$readquery = 'SELECT firstName, lastName FROM acknowledge_posts a, cadet c WHERE c.rin = a.rin and a.announcement_id = ' . $row['uid'] . ';';
//			$readres = $mysqli->query($readquery);
//			while ($readrow = $readres->fetch_assoc()) 
//            {
//				//print out the name of everyone who has clicked read and understood for this post
//				echo $readrow['firstName'] . ' ' . $readrow['lastName'] . '<br>';
//			}
//            echo "</div>";
//		}
        echo "</div>";
	}
	?>
      </div>
</div>
