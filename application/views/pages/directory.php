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

<?php // TODO: Re-add search feature for cadet's major and fix view funciton on profile cards ?>
<!--
<div class="jumbotron container-fluid">
    <h1 class="display-4"> Detachment Directory </h1><br>
      <?php // echo form_open('cadetdirectory/show'); ?>
        <select class="form-control" name="showcadets">
-->
<?php
//$result = $mysqli->query("SELECT major FROM cadet");
//$options = array();
//while($row = $result->fetch_assoc()) 
//{
//    if(!in_array($row['major'], $options) && strcmp("", $row['major']) != 0)
//    {
//       array_push($options, $row['major']);
//    } 
//}
?>
        <!-- <option value="all"  selected>All</option>'; -->
<?php
//foreach( $options as $option )
//{
//    // If option was selected makes it appear in dropdown as selected
//    if($_POST['showcadets'] == $option)
//    {
//        echo '<option selected value="' . $option . '">'. $option . '</option>'; 
//    }
//    else
//    {
//        echo '<option value="' . $option . '">'. $option . '</option>'; 
//    }
//}
?>
<!--
        </select><br>
        <button class="btn btn-sm btn-primary" type="submit" value="Submit" name="submit">Show Cadets</button><br><br>
    </form>
-->

    
<?php
foreach( $cadets as $cadet )
{
  if(file_exists("../../../images/". $cadet['rin'] . ".jpg"))
    {
      $file = "../../../images/". $cadet['rin'] . ".jpg";
    }
  else
    {
      $file = "../../../images/default.jpeg";
    }
    echo "<div class=\"card\" style=\"display:inline-block;text-align:center;\">";
    
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
