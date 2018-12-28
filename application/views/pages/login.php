<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <title><?php echo $title; ?></title>
    <link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
    <style>

/* Styles for mobile */
@media (max-width: 500px) 
{
    .card
    {
        width: 100%;
    }
}
@media (min-width: 500px) 
{
    .card
    {
        width: 40%;
    }
}
</style>

<body class="text-center"> 
<div class="card" style="margin: auto;padding: 10px;">
  <div class="card-body">
      <?php echo form_open('login/auth'); ?>
      <img class="img-fluid" src="<?php echo base_url("images/default.jpeg"); ?>" alt="Responsive image">
      <h5 class="card-title">Please Sign In</h5>
      <label for="uname"><b>Username</b></label><br>
      <input class="form-control" type="text" placeholder="Enter RIN" name="rin" required><br>

      <label for="psw"><b>Password</b></label><br>
      <input class="form-control" type="password" placeholder="Enter Password" name="psw" required><br>
      <br>
      <button class="btn btn-sm btn-primary" type="submit" name="submit">Login</button>
      <button class="btn btn-sm btn-secondary" type="reset" name="reset">Reset</button>
    </form>
      <br><?php echo anchor('login/forgot', 'Forgot Password'); ?>
  </div>
</div>
