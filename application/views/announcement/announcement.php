<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/announcement.css"); ?>">

<body>
<div class="jumbotron container-fluid">
    <div class='card'>
    <div class='card-header'><?php echo $announcement['title']; ?></div>
    <div class='card-body'><h5 class='card-title'><?php echo $announcement['subject']; ?></h5>
        <?php echo $announcement['body']; ?>
         <?php
            foreach($cadets as $cadet)
            {
                if($cadet['rin'] === $announcement['createdBy'])
                {
                    $firstName = $cadet['firstName'];
                    $lastName = $cadet['lastName'];
                }
            }
            ?>
            <p class='card-text'>Posted by: <?php echo $firstName . ' ' . $lastName; ?></p>
        <?php
        if($mypost)
        {
            echo form_open('announcement/edit');
            echo "<input style='display: none;' name='announcement' value='" . $announcement['uid'] . "'/>";
            echo "<button type='submit' class='btn btn-primary' id='edit'>Edit Announcement</button>";
            echo "</form>";
        }

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

        ?>
        </div>
    </div>
</div>

