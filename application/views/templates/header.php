<?php $this->load->helper('url'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url("images/favicon.ico"); ?>">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes"> 
    <script src="<?php echo base_url("application/third_party/jQuery/jquery-3.3.1.min.js"); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("application/third_party/bootstrap-4.3.1/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("application/third_party/bootstrap-4.3.1/css/bootstrap-grid.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("application/third_party/bootstrap-4.3.1/css/bootstrap-reboot.min.css"); ?>">
    <script type="text/javascript" src="<?php echo base_url("application/third_party/bootstrap-4.3.1/js/bootstrap.min.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("application/third_party/tinymce/jquery.tinymce.min.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("application/third_party/tinymce/tinymce.min.js"); ?>"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img src="<?php echo base_url("images/default.jpeg"); ?>" width="80" height="80" class="d-inline-block align-center" alt="">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <?php echo anchor('cadet/home', 'Home', 'class="nav-link"'); ?>
        </li>
        <li class="nav-item">
            <?php echo anchor('cadet/profile', 'Profile', 'class="nav-link"'); ?>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> More</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php echo anchor('attendance/view', 'Events', 'class="dropdown-item"'); ?>
            <?php echo anchor('announcement/view', 'Announcements', 'class="dropdown-item"'); ?>
            <?php echo anchor('cadetdirectory/view', 'Directory', 'class="dropdown-item"'); ?>
            <?php echo anchor('https://rpi.account.box.com/login', 'Media/Documents', 'class="dropdown-item"') ?>
            <?php echo anchor('wiki/view', 'Documentation', 'class="dropdown-item"'); ?>
            <?php echo anchor('email/view', 'Send Email', 'class="dropdown-item"'); ?>
            <?php echo anchor('pages/view/wingstructure', 'Org Chart', 'class="dropdown-item"'); ?>
            <?php echo anchor('attendance/master', 'Master Attendance', 'class="dropdown-item"'); ?>
            <?php echo anchor('attendance/weeklysummary', 'Weekly Attendance', 'class="dropdown-item"'); ?>

            <?php
                if( $this->session->userdata('admin') !== null && $this->session->userdata('admin') === true )
                {
                    echo anchor('cadet/view', 'Admin', 'class="dropdown-item"');
                }
          ?>
          </div>
          </li>
          <li class="nav-item">
            <?php echo anchor('login/logout', 'Log Out', 'class="nav-link"'); ?>
          </li>          
      </ul>
    </div>
  </nav>
