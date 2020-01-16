<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <script src="/application/third_party/jQuery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="/application/third_party/bootstrap-4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/application/third_party/bootstrap-4.3.1/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/application/third_party/bootstrap-4.3.1/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="/application/third_party/select2-4.0.12/css/select2.min.css">
    <link rel="stylesheet" href="/application/third_party/select2-4.0.12/css/select2-bootstrap.min.css">

    <script type="text/javascript" src="/application/third_party/bootstrap-4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/application/third_party/select2-4.0.12/js/select2.full.min.js"></script>
    <script type="text/javascript" src="/application/third_party/tinymce/jquery.tinymce.min.js"></script>
    <script type="text/javascript" src="/application/third_party/tinymce/tinymce.min.js"></script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img src="/images/default.jpeg" width="80" height="80" class="d-inline-block align-center" alt="">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a href="/index.php/cadet/home" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="/index.php/cadet/profile" class="nav-link">Profile</a>
            </li>
            <li class="nav-item">
                <a href="/index.php/cadetdirectory/view" class="nav-link" >Directory</a>
            </li>
            <li class="nav-item">
                <a href="/index.php/announcement/view" class="nav-link">Announcements</a>
            </li>
            <li class="nav-item">
                <a href="/index.php/attendance/view" class="nav-link">Event Attendance</a>
            </li>
            <li class="nav-item">
                <a href="https://1drv.ms/u/s!AuvfGdTu423La0njOdUq_ubV2R8?e=eyODRf" class="nav-link">Photos</a>
            </li>
            <li class="nav-item">
                <a href="https://1drv.ms/u/s!AuvfGdTu423LggbFuMcGqLDuT68s?e=tm3aE7" class="nav-link">OneDrive</a>
            </li>
            <li class="nav-item">
                <a href="https://calendar.google.com/calendar?cid=aDBlM2lkOW5pYThhZDc0M2xwY2Zxa3Y3Z29AZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ" class="nav-link">Calendar</a>
            </li>
            <li class="nav-item">
                <a href="/index.php/wiki/view" class="nav-link">Wiki</a>
            </li>
            <li class="nav-item">
                <a href="/documentation/site/index.html" class="nav-link">Documentation</a>
            </li>
            <li class="nav-item">
                <a href="/index.php/cadet/wingstructure" class="nav-link">Wing Structure</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> More</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a href="https://rpi.account.box.com/login" class="dropdown-item">BOX</a>
                    <a href="/index.php/email/view" class="dropdown-item">Send Email</a>
                    <a href="/index.php/alumni/view" class="dropdown-item">View Alumni</a>

                    <?php
                        if( $this->ion_auth->is_admin() )
                        {
                            echo anchor('cadet/view', 'Admin', 'class="dropdown-item"');
                            echo anchor('alumni/modify', 'Modify Alumni', 'class="dropdown-item"');
                        }
                        if( $this->ion_auth->is_admin() || $this->session->userdata('attendance') )
                        {
                            echo anchor('attendance/admin', 'Admin Attendance', 'class="dropdown-item"');
                            echo anchor('attendance/master', 'View Attendance', 'class="dropdown-item"');
                        }
                    ?>
                </div>
            </li>
            <li class="nav-item">
                <a href="/index.php/login/logout" class="nav-link">Log Out</a>
            </li>
        </ul>
    </div>
</nav>
