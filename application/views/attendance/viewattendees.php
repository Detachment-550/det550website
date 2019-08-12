<link rel="stylesheet" type="text/css" href="/css/viewattendees.css">

<body>
<div class="jumbotron container-fluid">
    <h2><?php echo $event['name']; ?> Attendees</h2>
    <strong>* Note: 1 = Yes | 0 = No</strong>
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
        echo "<td>" . $attendee['rank'] . ' ' . $attendee['last_name'] . "</td>";
        echo "<td>" . date("m/d/Y H:i:s", strtotime($attendee['time'])) . "</td>";
        echo "<td>" . $attendee['excused_absence'] . "</td>";
        echo "</tr>";
    }
?>
</table><br>

    <form method="POST" action="/index.php/attendance/export">
        <input type="text" name="event" value="<?php echo $event['eventID']; ?>" style="display: none;"/>
        <button class="btn btn-sm btn-primary" type="submit" name="submit">Export to Excel</button>
    </form>

</div>
</body>