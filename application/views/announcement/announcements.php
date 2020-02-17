<link rel="stylesheet" type="text/css" href="/css/announcements.css">

<a class="btn btn-primary float-right" href="/index.php/announcement/create">Make an Announcement</a>
<h1 class="display-4">Announcements</h1>
<br>
<div class='card'>
    <?php
        foreach($announcements as $announcement)
        {
            //print out the information for the post
            echo "<div class='card-header'><a href=" . site_url("announcement/page/" . $announcement->id) . ">" . $announcement->title . "</a></div>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . $announcement->subject . "</h5>";
            echo $announcement->body;
            echo "<strong>Posted: " . Date('d M Y h:i', strtotime($announcement->created_at)) . "</strong><br><br>";

            // Make a button to read and understand post
            $color = 'red';
            $user = $this->ion_auth->user()->row();
            foreach( $announcement->acknowledgements as $acknowledgement )
            {
                if ($acknowledgement->user->id == $user->id)
                {
                    $color = 'green';
                }
            }
            echo form_open('acknowledge_post/add');
            echo "<input type='text' value='" . $announcement->id . "' style='display:none;' name='announcementid'/>";
            echo "<button class='btn btn-sm btn-primary' type='submit' name='" . $announcement->id .
                "' style='float:left; background-color: $color'>Read and Understood</button></form>";

            // Print out the number of people that have read and understood the post
            // When it is clicked it prints out the list of people that have
            echo form_open('acknowledge_post/view');
            echo "<input type='text' style='display:none;' name='event' value='" . $announcement->id . "'>";
            echo '<input type="submit" name="count" value="'. count($announcement->acknowledgements) .'"/></form>';
            echo "</div>";
        }

        echo $links;
    ?>
</div>

