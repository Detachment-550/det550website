<script type="text/javascript" src="/application/third_party/tabulator/js/tabulator.min.js"></script>
<script type="text/javascript" src="/application/third_party/tabulator/pdf-plugin/jsPDF/jspdf.min.js"></script>
<script type="text/javascript" src="/application/third_party/tabulator/pdf-plugin/jsPDF-AutoTable/jspdf.plugin.autotable.min.js"></script>
<script type="text/javascript" src="/js/masterattendance.js"></script>
<link href="/application/third_party/tabulator/css/tabulator_simple.min.css" rel="stylesheet">


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
            <button type="button" class="btn btn-primary" style="float: right;margin: 10px;" onclick="download_week()">Download</button>
        </div>
        <br><br>
        <div id="weekattendance"></div>
    </div>

