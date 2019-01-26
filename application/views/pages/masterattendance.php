<h1>Semester Attendance</h1>
<table class="table table-sm">
    <thead>
    <tr>
        <th scope="col">Cadet</th>
        <?php
            $collen = count($table[0]);
            $rowlen = count($table);

            for($x = 0; $x < $collen; $x++)
            {
                echo "<th>" . $table[0][$x] . "</th>";
            }
        ?>
    </tr>
    </thead>
    <tbody>
    <?php
        for($row = 1; $row < $rowlen; $row++)
        {
            echo "<tr>";

            for ($col = 0; $col <= $collen; $col++)
            {
                echo "<th>" . $table[$row][$col] . "</th>";
            }

            echo "</tr>";
        }
    ?>
    </tbody>
</table>

