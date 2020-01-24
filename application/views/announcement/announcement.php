<link rel="stylesheet" type="text/css" href="/css/announcement.css">

<div class='card'>
    <div class='card-header'><?php echo $announcement->title; ?></div>
    <div class='card-body'><h5 class='card-title'><?php echo $announcement->subject; ?></h5>
        <?php echo $announcement->body; ?>
        <p class='card-text'>Posted by: <?php echo $announcement->created_by->rank . ' ' . $announcement->created_by->last_name; ?></p>
        <?php
            if($mypost)
            {
                echo form_open('announcement/edit');
                echo "<input style='display: none;' name='announcement' value='" . $announcement->id . "'/>";
                echo "<button type='submit' class='btn btn-primary' id='edit'>Edit Announcement</button>";
                echo "</form>";
            }

            // Make a button to read and understand post
            echo form_open('acknowledge_post/add');
            echo "<input type='text' value='" . $announcement->id . "' style='display:none;' name='announcementid'/>";
            echo "<button class='btn btn-sm btn-primary' type='submit' name='" . $announcement->id .
                "' style='float:left;'>Read and Understood</button></form>";

            // Print out the number of people that have read and understood the post
            // When it is clicked it prints out the list of people that have
            echo form_open('acknowledge_post/view');
            echo "<input type='text' style='display:none;' name='event' value='" . $announcement->id . "'>";
            echo '<input type="submit" name="count" value="'. count($announcement->acknowledgements) .'"/></form>';
            echo "</div>";
        ?>
    </div>
</div>

