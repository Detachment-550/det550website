<table class="table table-sm">
    <thead>
    <tr>
        <th scope="col">Cadet</th>
        <?php
            foreach ($events as $event)
            {
                echo "<th>" . $event['name'] . "</th>";
            }
        ?>
    </tr>
    </thead>
    <tbody>
    <?php
        foreach ($cadets as $cadet)
        {
            $found = false;
            echo "<tr>";
            echo "<th scope='row'>". $cadet['lastName']  . "</th>";
            foreach ($events as $event)
            {
                foreach ($attendees as $attendee)
                {
                    if($attendee['rin'] === $cadet['rin'] && $event['eventID'] === $attendee['eventid'])
                    {
                        if($attendee['excused_absence'] == 1)
                        {
                            echo "<th>E</th>";
                            $found = true;
                            break;
                        }
                        else
                        {
                            echo "<th>P</th>";
                            $found = true;
                            break;
                        }
                    }
                }

                if($found === false)
                {
                    echo "<th>A</th>";
                }
                else
                {
                    $found = false;
                }
            }
        }
    ?>
    </tbody>
</table>

