<link rel="stylesheet" type="text/css" href="/css/acknowledged.css">

<div class="jumbotron container-fluid">
    <h2><?php echo $announcement->title; ?> HUA</h2>

<table>
  <tr>
    <th>Name</th>
    <th>Time</th>
  </tr>
<?php 
    // Prints out the cadet that has acknowledged the annoucement and when
    foreach( $announcement->acknowledgements as $acknowledgement )
    {
        echo "<tr>";
        echo "<td>" . $acknowledgement->user->rank . " " . $acknowledgement->user->last_name . "</td>";
        echo "<td>" . $acknowledgement->created_at . "</td>";
        echo "</tr>";
    }
?>
</div>