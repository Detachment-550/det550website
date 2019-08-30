<link href="/application/third_party/tabulator/tabulator_bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript" src="/application/third_party/tabulator/tabulator.min.js"></script>
<script type="text/javascript" src="/application/third_party/tabulator/pdf-plugin/jsPDF/jspdf.min.js"></script>
<script type="text/javascript" src="/application/third_party/tabulator/pdf-plugin/jsPDF-AutoTable/jspdf.plugin.autotable.min.js"></script>
<script type="text/javascript" src="/js/masterattendance.js"></script>


<div class="jumbotron" style="height: -webkit-fill-available; overflow: auto; padding: 5px;">
    <div class="shadow p-3 mb-5 bg-white rounded" style="margin: 5px;">
        <div>
            <h1 style="display: inline;">Semester Attendance</h1>
            <button type="button" class="btn btn-primary" style="float: right;margin: 10px;" onclick="download()">Download</button>
        </div>
        <br><br>

        <div id="attendance"></div>
    </div>

    <div class="shadow p-3 mb-5 bg-white rounded" style="margin: 5px;">
        <div>
            <h1 style="display: inline;">Weekly Attendance</h1>
            <button type="button" class="btn btn-primary" style="float: right;margin: 10px;" onclick="downloadweek()">Download</button>
        </div>
        <br><br>
        <div id="weekattendance"></div>
    </div>

    </div>
