<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url("images/favicon.ico"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <title><?php echo $title; ?></title>
    <link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet'>
    <script src="<?php echo base_url("js/jQuery/jquery-3.3.1.min.js"); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("css/bootstrap-4.3.1/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("css/bootstrap-4.3.1/css/bootstrap-grid.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("css/bootstrap-4.3.1/css/bootstrap-reboot.min.css"); ?>">
    <script type="text/javascript" src="<?php echo base_url("css/bootstrap-4.3.1/js/bootstrap.min.js"); ?>"></script>

    <div class="jumbotron container-fluid">
  <div class="container">
    <h1 class="display-4">Security Question</h1>
    <div style="width:90%;display:block;margin-left:auto;margin-right:auto;" class="card" id="Edit Groups">
      <div class="card-body">

      <?php echo form_open('login/resetpass'); ?>
      <h4>Security Question:</h4>
            RIN: <input type='text' name='rin' id='rin' value='<?php echo $cadet['rin']; ?>' readonly><br><br>
            <?php echo $cadet['question']; ?>
            <br><br><h4 class='card-text'>Response:</h4>
          
          <input type="text" style="width:100%;" name="answer" id="answer" placeholder="Answer is case sensitive"><br><br>
            
          <button class="btn btn-sm btn-primary" type="submit" name="submit">Submit</button>
        </form><br>
    </div>
</div>
