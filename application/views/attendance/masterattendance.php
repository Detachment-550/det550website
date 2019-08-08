<link href="/application/third_party/tabulator/tabulator_bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="/application/third_party/tabulator/tabulator.min.js"></script>
<script type="text/javascript" src="/application/third_party/tabulator/pdf-plugin/jsPDF/jspdf.min.js"></script>
<script type="text/javascript" src="/application/third_party/tabulator/pdf-plugin/jsPDF-AutoTable/jspdf.plugin.autotable.min.js"></script>
<script type="text/javascript" src="/js/masterattendance.js"></script>


<div class="jumbotron" style="height: -webkit-fill-available; overflow: auto; padding: 5px;">
    <div class="shadow p-3 mb-5 bg-white rounded" style="margin: 5px;">
        <h1>Semester Attendance</h1>

        <button type="button" class="btn btn-primary" style="float: right;margin: 10px;" onclick="download()">Download Table</button><br><br>

        <div id="attendance"></div>
    </div>

    <div class="shadow p-3 mb-5 bg-white rounded" style="margin: 5px;">

        <h1>Weekly Attendance</h1>

        <button type="button" class="btn btn-primary" style="float: right;margin: 10px;" onclick="downloadweek()">Download Table</button><br><br>

        <div id="weekattendance"></div>
    </div>

    <div class="shadow p-3 mb-5 bg-white rounded" style="margin: 5px;">
        <h1>Submit Attendance Memo</h1>
        <form action="/index.php/attendance/create_memo" method="POST">
            <div class="form-group">
                <label for="event">Select Event</label>
                <select id="event" name="event" class="form-control" required>
                    <option value="">Choose...</option>
                    <?php
                        foreach ($events as $event) {
                            echo '<option value="' . $event["eventID"] . '">' . $event["name"] . '</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="excuse_type">Memo Reason</label>
                <select id="excuse_type" name="excuse_type" class="form-control" required>
                    <option value="">Choose...</option>
                    <?php
                        foreach ($excuse_types as $excuse_type) {
                            echo '<option value="' . $excuse_type["excuse_type_id"] . '">' . $excuse_type["label"] . '</option>';
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="comments">Comments</label>
                <textarea rows="7" class="form-control" id="comments" name="comments" placeholder="Provide any information about the reason..." required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Memo</button>
        </form>
    </div>

    </div>

<script>loadattendance('<?php echo site_url(); ?>')</script>
