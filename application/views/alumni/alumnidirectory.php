<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/alumdirectory.css"); ?>">

<!--TODO: Use boot strap card decks here to manage the card sizes -->
<div class="jumbotron">
    <h1 class="display-4"> Alumni Directory </h1><br>
    <?php
    foreach( $alumni as $alum )
    {
        if( is_file('./images/' . $alum['image']) )
        {
            $file = base_url('images/' . $alum['image']);
        }
        else
        {
            $file = base_url("images/default.jpeg");
        }

        echo "<div class='card' style='display:inline-block;text-align:center;'>";

        // This needs to be fixed with cadet's picture
        echo "  <img class='img-fluid' style='height:200px;width:200px;' src='" . $file . "' alt='Alumni Profile Picture'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'> " . $alum['rank'] . " " . $alum['last_name'] . "</h5>";
        echo "<p class='card-text'><strong>Email: </strong>" . $alum['email'] . "<br><strong>Phone: </strong>" . $alum['phone'];
        echo "<br><strong>Job: </strong>" . $alum['position'] . "</p></div>";
        echo '<br><div class="card-footer"><small class="text-muted">' . $alum['major'] . '</small></div></div>';
    }
    ?>
</div>