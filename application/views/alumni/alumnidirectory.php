<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/directory.css"); ?>">

<!--TODO: Use boot strap card decks here to manage the card sizes -->
<div class="jumbotron">
    <h1 class="display-4"> Detachment Directory </h1><br>
    <?php
    //TODO: Find a better way to do this
    $images = scandir("./images");
    foreach( $alumnis as $alumni )
    {
        if( in_array($alumni['alum'] . ".jpg", $images) )
        {
            $file = base_url("images/" . $alumni->id . ".jpg" );
        }
        else if( in_array($alumni->id . ".png", $images) )
        {
            $file = base_url("images/" . $alumni->id . ".png" );
        }
        else if( in_array($alumni->id . ".jpeg", $images) )
        {
            $file = base_url("images/" . $alumni->id . ".jpeg" );
        }
        else
        {
            $file = base_url("images/default.jpeg");
        }

        echo "<div class='card' style='display:inline-block;text-align:center;'>";

        // This needs to be fixed with cadet's picture
        echo "  <img class='img-fluid' style='height:200px;width:200px;' src='" . $file . "' alt='Cadet Profile Picture'>";
        echo "<div class='card-body'>";
        if(strpos($alumni->class, "None") !== false)
        {
            echo "<h5 class='card-title'> " . $alumni->first_name . " " . $alumni->last_name . "</h5>";
        }
        else
        {
            echo "<h5 class='card-title'>" . $alumni->rank . " " . $alumni->last_name . "</h5>";
        }
        echo "<p class='card-text'><strong>Class: </strong>" . $alumni->class . "<br><strong>Flight: </strong>" . $alumni->flight . "</p></div>";
        echo '<div class="card-footer"><small class="text-muted">' . $alumni->major . '</small></div></div>';
    }
    ?>
</div>