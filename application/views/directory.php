<link rel="stylesheet" type="text/css" href="/css/directory.css">

<!--TODO: Use boot strap card decks here to manage the card sizes -->
<div class="jumbotron">
    <h1 class="display-4"> Detachment Directory </h1><br>
<?php

foreach( $users as $user )
{
    if($user->class != 'None' ){
        if( is_file('./images/' . $user->image) )
        {
            $file = base_url('images/' . $user->image);
        }
        else
        {
            $file = base_url("images/default.jpeg");
        }

        echo "<div class='card' style='display:inline-block;text-align:center;'>";

        // This needs to be fixed with cadet's picture
        echo "  <img class='img-fluid' style='height:200px;width:250px;' src='" . $file . "' alt='Cadet Profile Picture'>";
        echo "<div class='card-body'>";
        if(strpos($user->class, "None") !== false)
        {
            echo "<h5 class='card-title'> " . $user->first_name . " " . $user->last_name . "</h5>";
        }
        else
        {
            echo "<h5 class='card-title'>" . $user->rank . " " . $user->last_name . "</h5>";
        }
        echo "<p class='card-text'><strong>Class: </strong>" . $user->class . "<br><strong>Flight: </strong>" . $user->flight . "</p>";
        echo form_open('cadetdirectory/profile');
        echo "<input value='" . $user->id . "' name='id' style='display:none;' readonly>";
        echo "<button class='btn btn-sm btn-primary' type='submit'>View Profile</button></form></div>";
        echo '<div class="card-footer"><small class="text-muted">' . substr($user->major, 0, 32) . '</small></div></div>';

    }
}
?>
</div>