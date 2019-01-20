<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/announcements.css"); ?>">

<body>
  <div class="jumbotron container-fluid">
	<h1 class="display-4"> Announcements </h1><br>
    <?php echo form_open('announcement/create'); ?>
          	<button class="btn btn-primary" type="submit">Make an Announcement</button><br><br>
      </form>
    <div class='card'>
<?php
	foreach($announcements as $announcement)
    {
		//print out the information for the post
		echo "<div class='card-header'>" . $announcement['title'] . "</div>";
		echo "<div class='card-body'><h5 class='card-title'>" . $announcement['subject'] . "</h5>";
        echo $announcement['body'];

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

		// Make a button to read and understand post
        echo form_open('acknowledge_post/add');
        echo "<input type='text' value='" . $announcement['uid'] . "' style='display:none;' name='announcementid'/>";
		echo "<button class='btn btn-sm btn-primary' type='submit' name='" . $announcement['uid'] . "' style='float:left;'>Read and Understood</button></form>";
        
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
		echo form_open('acknowledge_post/view');
        echo "<input type='text' style='display:none;' name='event' value='" . $announcement['uid'] . "'>";
		echo '<input type="submit" name="count" value="'. $count .'"/></form>';
        echo "</div>";
	}
	?>
        <?php echo $links; ?>
      </div>
</div>

