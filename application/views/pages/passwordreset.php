<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url("images/favicon.ico"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <title><?php echo $title; ?></title>
    <link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
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
