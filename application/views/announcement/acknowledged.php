<link rel="stylesheet" type="text/css" href="/css/acknowledged.css">

<div class="jumbotron container-fluid">
    <h2><?php echo $announcement['title']; ?> HUA</h2>

<table>
  <tr>
    <th>Name</th>
    <th>Time</th>
  </tr>
<?php 
    // Prints out the cadet that has acknowledged the annoucement and when
    foreach( $users as $user )
    {
        foreach( $acknowledgements as $ack )
        {
            if( $ack['user'] === $user->id )
            {
                echo "<tr>";
                echo "<td>" . $user->rank . " " . $user->last_name . "</td>";
                echo "<td>" . $ack['time'] . "</td>";
                echo "</tr>";
            }
        }
    }
?>
</div>