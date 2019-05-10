<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url("images/favicon.ico"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <title><?php echo $title; ?></title>
    <link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet'>
    <script src="<?php echo base_url("application/third_party/jQuery/jquery-3.3.1.min.js"); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("application/third_party/bootstrap-4.3.1/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("application/third_party/bootstrap-4.3.1/css/bootstrap-grid.min.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("application/third_party/bootstrap-4.3.1/css/bootstrap-reboot.min.css"); ?>">
    <script type="text/javascript" src="<?php echo base_url("application/third_party/bootstrap-4.3.1/js/bootstrap.min.js"); ?>"></script>

    <div class="jumbotron container-fluid" style="height: -webkit-fill-available;margin: 0px;">
        <div class="container">
            <h1 class="display-4">Security Question</h1>
            <div style="width:90%;display:block;margin-left:auto;margin-right:auto;" class="card" id="Edit Groups">
                <div class="card-body">

                    <?php echo form_open('login/resetpass'); ?>
                    <h4>Security Question:</h4>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type='text' name='email' id='email' value='<?php echo $user['email']; ?>' class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="answer"><?php echo $user['question']; ?></label>
                        <input type="text" class="form-control" name="answer" id="answer" placeholder="Answer is case sensitive" required>
                    </div>

                    <button class="btn btn-sm btn-primary" type="submit" name="submit">Submit</button>
                    </form><br>
                </div>
            </div>
