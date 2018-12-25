<style>
/* Styles for mobile */
@media (max-width: 450px) 
{
    .card
    {
        width:95%;
    }
    body
    {
        min-width: 400px;
    }
}
</style>
<div class="jumbotron container-fluid">
    <h1 class="display-4"> Detachment Directory </h1><br>
      <?php echo form_open('cadetdirectory/major'); ?>
        <select class="form-control" name="showcadets">
<?php
    if(strcmp("all", $selected) == 0 )
    {
        echo "<option selected value='all'>All</option>";
    }
    else
    {
        echo "<option value='all'>All</option>";
    }
    foreach( $majors as $major )
    {
        if( strcmp($major->major, "") != 0 && strcmp($major->major, $selected) == 0 )
        {
            echo "<option selected value='" . $major->major . "'>" . $major->major . "</option>";
        }
        else if( strcmp($major->major, "") != 0 )
        {
            echo "<option value='" . $major->major . "'>" . $major->major . "</option>";
        }
    }
?>
        </select><br>
        <button class="btn btn-sm btn-primary" type="submit" value="Submit" name="submit">Show Cadets</button><br><br>
    </form>

    
<?php
$images = scandir("./images");
foreach( $cadets as $cadet )
{
    if( in_array($cadet['rin'] . ".jpg", $images) )
    {
        $file = "../../../images/" . $cadet['rin'] . ".jpg";
    }
    else if( in_array($cadet['rin'] . ".png", $images) )
    {
        $file = "../../../images/" . $cadet['rin'] . ".png";
    }
    else if( in_array($cadet['rin'] . ".jpeg", $images) )
    {
        $file = "../../../images/" . $cadet['rin'] . ".jpeg";
    }
    else
    {
        $file = "../../../images/default.jpeg";
    }
    
    echo "<div class='card' style='display:inline-block;text-align:center;'>";
    
    // This needs to be fixed with cadet's picture
    echo "  <img class='img-fluid' style='padding:5px;height:200px;width:200px;' src='" . $file . "' alt='Cadet Profile Picture'>";
    echo "<div class='card-body'>";
    if(strpos($cadet['rank'], "AS") !== false)
    {
        echo "<h5 class='card-title'>Cadet " . $cadet['lastName'] . "</h5>";
    }
    else if(strpos($cadet['rank'], "None") !== false)
    {
        echo "<h5 class='card-title'> " . $cadet['firstName'] . " " . $cadet['lastName'] . "</h5>";
    }
    else
    {
        echo "<h5 class='card-title'>" . $cadet['rank'] . " " . $cadet['lastName'] . "</h5>";
    }
    echo "<p class='card-text'><strong>Rank: </strong>" . $cadet['rank'] . "<br><strong>Flight: </strong>" . $cadet['flight'] . "</p>";
    echo form_open('cadetdirectory/profile');
    echo "<input value='" . $cadet['rin'] . "' name='rin' style='display:none;' readonly>";
    echo "<button class='btn btn-sm btn-primary' type='submit'>View Profile</button></form></div></div>";
}
?>
