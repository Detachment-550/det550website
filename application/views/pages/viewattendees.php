<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

.jumbotron {
    margin-bottom: 0;
}
</style>

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
        echo "<tr>";
    }
?>
</div>