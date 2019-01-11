<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/viewattendees.css"); ?>">

<body>
<div class="jumbotron container-fluid">
    <h2><?php echo $event['name']; ?> Attendees</h2>

<table>
  <tr>
    <th>Name</th>
    <th>Time</th>
    <th>Excused</th>
  </tr>
<?php 
    foreach( $attendees as $attendee )
    {
        echo "<tr>";
        echo "<td>Cadet " . $attendee['lastName'] . "</td>";
        echo "<td>" . $attendee['time'] . "</td>";
        echo "<td>" . $attendee['excused_absence'] . "</td>";
        echo "</tr>";
    }
?>
</div>