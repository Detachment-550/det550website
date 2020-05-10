<link rel="stylesheet" type="text/css" href="/css/announcements.css">

<a class="btn btn-primary float-right" href="/index.php/announcement/create">Make an Announcement</a>
<h1 class="display-4">Announcements</h1>

<div class="shadow-sm p-3 mb-5 bg-white rounded">
    <form method="POST" action="/index.php/announcement/search">
        <div class="form-group">
            <label for="field">Search Field</label>
            <select id="field" name="post_select" class="form-control" required><?php
                if(isset($post_select)) {

                    if ($post_select == 'title') {
                        echo '<option selected value="title">Announcement Title</option>';
                        echo '<option value="subject">Subject of Announcement</option>';
                        echo '<option value="body">Body of Announcement</option>';

                    } elseif ($post_select == 'subject') {
                        echo '<option selected value="subject">Subject of Announcement</option>';
                        echo '<option value="title">Announcement Title</option>';
                        echo '<option value="body">Body of Announcement</option>';

                    } elseif ($post_select == 'body') {
                        echo '<option selected value="body">Body of Announcement</option>';
                        echo '<option value="title">Announcement Title</option>';
                        echo '<option value="subject">Subject of Announcement</option>';

                    }
                }
                else
                {
                    echo '<option selected value="">Please Select a Search Option..</option>';
                    echo '<option value="title">Announcement Title</option>';
                    echo '<option value="subject">Subject of Announcement</option>';
                    echo '<option value="body">Body of Announcement</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="post_value" placeholder="Enter search value..." value="<?php
                if(isset($post_value))
                {
                    echo $post_value;
                }
            ?>" id="post_value" required>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="/index.php/announcement/view" class="btn btn-secondary">Reset Page</a>
    </form>
</div>

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
                echo "<button class='btn btn-sm btn-primary' id='acknowledge_post_" . $announcement->id . "' onclick=acknowledge_post(" . $announcement->id . ") type='button' name='" . $announcement->id .
                    "' style='float:left; background-color: $color'>Read and Understood</button>";

            // Print out the number of people that have read and understood the post
            // When it is clicked it prints out the list of people that have
            echo form_open('acknowledge_post/view');
            echo "<input type='text' style='display:none;' name='event' value='" . $announcement->id . "'>";
            echo '<input type="submit" name="count" id="acknowledge_count_' . $announcement->id . '" value="'. count($announcement->acknowledgements) .'"/></form>';
            echo "</div>";
        }

        echo $links;
    ?>
</div>

<script type="text/javascript" src="/js/announcements.js"></script>