<h1>Semester Attendance</h1>
<script type="text/javascript" src="<?php echo base_url("application/third_party/tabulator/tabulator.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("application/third_party/tabulator/pdf-plugin/jsPDF/jspdf.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("application/third_party/tabulator/pdf-plugin/jsPDF-AutoTable/jspdf.plugin.autotable.min.js"); ?>"></script>
<link href="<?php echo base_url("application/third_party/tabulator/tabulator.min.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("application/third_party/tabulator/tabulator_bootstrap4.min.css"); ?>" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url('js/masterattendance.js'); ?>"></script>

<button type="button" class="btn btn-primary" style="float: right;margin: 10px;" onclick="download()">Download Table</button><br><br>

<div id="attendance"></div>

<script>loadattendance('<?php echo site_url(); ?>')</script>
