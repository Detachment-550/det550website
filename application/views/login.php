<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url("images/favicon.ico"); ?>">
    <title><?php echo $title; ?></title>
    <link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet'>
    <script src="<?php echo base_url("application/third_party/jQuery/jquery-3.3.1.min.js"); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("application/third_party/bootstrap-4.3.1/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("application/third_party/bootstrap-4.3.1/css/bootstrap-grid.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("application/third_party/bootstrap-4.3.1/css/bootstrap-reboot.min.css"); ?>">
    <script type="text/javascript" src="<?php echo base_url("application/third_party/bootstrap-4.3.1/js/bootstrap.min.js"); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url("css/login.css"); ?>">
</head>

<body class="text-center"> 
<div class="card" style="margin: auto;padding: 10px;">
  <div class="card-body">
      <?php echo form_open('login/auth'); ?>
      <img class="img-fluid" src="<?php echo base_url("images/default.jpeg"); ?>" alt="Responsive image">
      <h5 class="card-title">Please Sign In</h5>
      <label for="uname"><b>Email</b></label><br>
      <input class="form-control" type="text" placeholder="Enter your email" name="user" required><br>

      <label for="psw"><b>Password</b></label><br>
      <input class="form-control" type="password" placeholder="Enter your password" name="psw" required><br>
      <br>
      <button class="btn btn-sm btn-primary" type="submit" name="submit">Login</button>
      <button class="btn btn-sm btn-secondary" type="reset" name="reset">Reset</button>
    </form>
      <br><?php echo anchor('login/forgot', 'Forgot Password'); ?>
  </div>
</div>
