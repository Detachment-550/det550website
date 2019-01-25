<h1>Semester Attendance</h1>
<table class="table table-sm">
    <thead>
    <tr>
        <th scope="col">Cadet</th>
        <?php
            $month = date('m');
            $year = date('Y');

            foreach ($events as $event)
            {
                if(($month > 6 && date("m", strtotime($event['date'])) > 6 || $month <= 6 && date("m", strtotime($event['date'])) <= 6) && (date("Y", strtotime($event['date'])) == $year))
                {
                    echo "<th>" . $event['name'] . "</th>";
                }
            }
        ?>
        <th>PT Total</th>
        <th>LLAB Total</th>
    </tr>
    </thead>
    <tbody>
    <?php
        foreach ($cadets as $cadet)
        {
            // If person is not a cadet attendance is not shown
            if(strpos($cadet['rank'], 'AS') !== false) {
                $found = false;
                $pt = 0;
                $llab = 0;
                echo "<tr>";
                echo "<th scope='row'>" . $cadet['lastName'] . "</th>";
                foreach ($events as $event) {
                    if (($month > 6 && date("m", strtotime($event['date'])) > 6 || $month <= 6 && date("m", strtotime($event['date'])) <= 6) && (date("Y", strtotime($event['date'])) == $year)) {
                        $cursemester = true;
                    } else {
                        $cursemester = false;
                    }

                    // If the event didn't take place in the current semester event is not shown
                    if ($cursemester) {
                        foreach ($attendees as $attendee) {
                            if ($attendee['rin'] === $cadet['rin'] && $event['eventID'] === $attendee['eventid']) {
                                if ($attendee['excused_absence'] == 1) {
                                    echo "<th>E</th>";
                                    $found = true;
                                    break;
                                } else {
                                    echo "<th>P</th>";
                                    $found = true;
                                    $month = date('m');
                                    $year = date('Y');

                                    if ($event['pt'] == 1) {
                                        $pt += 1;
                                    } else if ($event['llab'] == 1) {
                                        $llab += 1;
                                    }
                                    break;
                                }
                            }
                        }
                    }

                    if ($found === false && $cursemester) {
                        echo "<th>A</th>";
                    } else {
                        $found = false;
                    }
                }

                echo "<th>" . $pt . "/" . $ptsum . "</th>";
                echo "<th>" . $llab . "/" . $llabsum . "</th>";
                $pt = 0;
                $llab = 0;
            }
        }
    ?>
    </tbody>
</table>

