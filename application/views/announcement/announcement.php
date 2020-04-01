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

            $color = 'red';
            $user = $this->ion_auth->user()->row();
            foreach( $announcement->acknowledgements as $acknowledgement )
            {
                if ($acknowledgement->user->id == $user->id)
                {
                    $color = 'green';
                }
            }
            echo "<button class='btn btn-sm btn-primary' id='acknowledge_post_" . $announcement->id . "' onclick=acknowledge_post(" . $announcement->id . ") type='button' name='" . $announcement->id .
                "' style='float:left; background-color: $color'>Read and Understood</button>";

            // Print out the number of people that have read and understood the post
            // When it is clicked it prints out the list of people that have
            echo form_open('acknowledge_post/view');
            echo "<input type='text' style='display:none;' name='event' value='" . $announcement->id . "'>";
            echo '<input type="submit" name="count" id="acknowledge_count_' . $announcement->id . '" value="'. count($announcement->acknowledgements) .'"/></form>';
            echo "</div>";
        ?>
    </div>
</div>

<script type="text/javascript" src="/js/announcements.js"></script>