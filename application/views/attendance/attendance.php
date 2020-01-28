<link rel="stylesheet" type="text/css" href="/css/attendance.css">

<div class="shadow p-3 mb-5 bg-white rounded" style="margin: 5px;">
    <h1>View Event Attendees</h1>
    <label for="event">Select Event</label>
    <select class="form-control" name="event" id="event" required>
        <option value="">Choose...</option>
        <?php
            foreach($events as $event)
            {
                echo '<option value="' . $event->id . '">' . $event->name . ' - ' . Date('Y-m-d', strtotime($event->date)) . '</option>';
            }
        ?>
    </select>
    <br>
    <br>
    <button class="btn btn-sm btn-primary" type="button" onclick="view_attendance()">View Attendees</button>
</div>


<script type="text/javascript" src="/js/attendance.js"></script>
