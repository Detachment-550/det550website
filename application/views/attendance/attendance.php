<link rel="stylesheet" type="text/css" href="/css/attendance.css">

<div class="jumbotron container-fluid">
    <h1 class="display-4"> Events </h1>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="card" style="margin: auto;padding: 10px;">
                    <h5 class="card-title">Create an Event</h5>
                    <form action="/index.php/cadetevent/add" method="POST">
                        <div class="form-group">
                            <label for=title><b>Title: </b></label>
                            <input class="form-control" id="title" type="text" name="name" required/>
                        </div>

                        <div class="form-group">
                            <label for=date><b>Date: </b></label>
                            <input class="form-control" id="date" type="datetime-local" name="date" required/>
                        </div>

                        <div class="form-group">
                            <label for=mandatory><b>Event Type: </b></label>
                            <select name="type" id="mandatory" class="form-control" required>
                                <option value="">Choose...</option>
                                <option value="nonpmt">Non PMT</option>
                                <option value="pt">PT</option>
                                <option value="llab">LLAB</option>
                            </select>
                        </div>
                        <br><br>
                        <button class="btn btn-sm btn-primary" type="submit" value="Submit" name="eventMade">Submit</button>
                    </form>
                </div>
            </div>

            <div class="col-6">
                <div class="card" style="margin: auto;width: 100%;padding: 10px;">
                    <label for="event"><h5 class="card-title">Select Event</h5></label>
                    <form action="/index.php/attendance/attendees" method="POST">
                        <select class="form-control" name="event" id="event" required>
                            <option value="">Choose...</option>
                            <?php
                                foreach($events as $event)
                                {
                                    echo '<option value="' . $event['eventID'] . '">' . $event['name'] . '</option>';
                                }
                            ?>
                        </select><br>
                        <button class="btn btn-sm btn-primary" type="submit" value="submit" name="selectevent">View Attendees</button><br><br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>