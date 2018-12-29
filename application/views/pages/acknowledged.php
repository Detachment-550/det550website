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
    height: -webkit-fill-available;
}
</style>
</head>
<body>
<div class="jumbotron container-fluid">
    <h2><?php echo $announcement['title']; ?> HUA</h2>

<table>
  <tr>
    <th>Name</th>
    <th>Time</th>
  </tr>
<?php 
    // Prints out the cadet that has acknowledged the annoucement and when
    foreach( $cadets as $cadet )
    {
        foreach( $acknowledgements as $ack )
        {
            if( $ack['rin'] === $cadet['rin'] )
            {
                echo "<tr>";
                echo "<td>Cadet " . $cadet['lastName'] . "</td>";
                echo "<td>" . $ack['time'] . "</td>";
                echo "<tr>";
            }
        }
    }
?>
</div>