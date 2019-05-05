<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/directory.css"); ?>">

<!--TODO: Use boot strap card decks here to manage the card sizes -->
<div class="jumbotron">
    <h1 class="display-4"> Detachment Directory </h1><br>
<?php
//TODO: Find a better way to do this
$images = scandir("./images");
foreach( $users as $user )
{
    if( in_array($user->username . ".jpg", $images) )
    {
        $file = base_url("images/" . $user->username . ".jpg" );
    }
    else if( in_array($user->username . ".png", $images) )
    {
        $file = base_url("images/" . $user->username . ".png" );
    }
    else if( in_array($user->username . ".jpeg", $images) )
    {
        $file = base_url("images/" . $user->username . ".jpeg" );
    }
    else
    {
        $file = base_url("images/default.jpeg");
    }
    
    echo "<div class='card' style='display:inline-block;text-align:center;'>";
    
    // This needs to be fixed with cadet's picture
    echo "  <img class='img-fluid' style='height:200px;width:200px;' src='" . $file . "' alt='Cadet Profile Picture'>";
    echo "<div class='card-body'>";
    if(strpos($user->class, "AS") !== false)
    {
        echo "<h5 class='card-title'>Cadet " . $user->last_name . "</h5>";
    }
    else if(strpos($user->class, "None") !== false)
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
    echo '<div class="card-footer"><small class="text-muted">' . $user->major . '</small></div></div>';
}
?>
</div>