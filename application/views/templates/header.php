<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes"> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- include libraries(jQuery, bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <img src="../../../images/default.jpeg" width="80" height="80" class="d-inline-block align-center" alt="">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a href="/index.php/cadet/home" class="nav-link" type="submit">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/index.php/cadet/profile" type="submit">Profile</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> More</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/index.php/attendance/view" type="submit">Events</a>
            <a class="dropdown-item" href="/index.php/announcement/view" type="submit">Announcements</a>
            <a type="submit" class="dropdown-item" href="/index.php/cadetdirectory/view">Directory</a>
            <a class="dropdown-item" href="https://rpi.account.box.com/login">Media/Documents</a>
            <a class="dropdown-item" href="/index.php/wiki/view">Documentation</a>
            <a class='dropdown-item' href='/index.php/email/view'>Send Email</a>
          <?php 
                if( isset($admin) && $admin === true )
                {
                    echo "<a class='dropdown-item' href='/index.php/cadet/view'>Admin</a>";
                }
          ?>
          </div>
          </li>
          <li class="nav-item">
            <a href="/index.php/login/logout" class="nav-link" type="submit">Log Out</a>
          </li>          
      </ul>
    </div>
  </nav>