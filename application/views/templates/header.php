<?php
//require_once('./assets/inc/dbinfo.php');
//require_once('./assets/objects/cadet.php');
//session_start();

// Checks to see if user is already logged in
//if ( isset($_SESSION['login']) && $_SESSION['login'] )
//{
//    $cadet = new cadet( $_SESSION["rin"], $mysqli );
//}
?>

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
  
<!-- include summernote css/js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
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
            <?php echo form_open('cadet/home'); ?>
                <button style="background-color:transparent;border:none;cursor:pointer;" class="nav-link" type="submit">Home</button>
            </form>
        </li>
        <li class="nav-item">
            <?php echo form_open('cadet/profile'); ?>
                <button style="background-color:transparent;border:none;cursor:pointer;" class="nav-link" type="submit">Profile</button>
            </form>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> More</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php echo form_open('attendance/view'); ?>
            <button class="dropdown-item" style="background-color:transparent;border:none;cursor:pointer;" type="submit">Events</button>
        </form>
            <?php echo form_open('announcement/view'); ?>
            <button class="dropdown-item" style="background-color:transparent;border:none;cursor:pointer;" type="submit">Announcements</button>
        </form>          
            <?php echo form_open('cadetdirectory/view'); ?>
            <button type="submit" class="dropdown-item" style="background-color:transparent;border:none;cursor:pointer;">Directory</button>
        </form>
          <a class="dropdown-item" href="https://rpi.account.box.com/login">Media/Documents</a>
            <?php echo form_open('wiki/view'); ?>
            <button type="submit" class="dropdown-item" style="background-color:transparent;border:none;cursor:pointer;">Documentation</button>
        </form>            
            <?php echo form_open('email/view'); ?>
            <button type="submit" class="dropdown-item" style="background-color:transparent;border:none;cursor:pointer;">Send Email</button>
        </form>
          <?php 
//            if(isset($_SESSION["rin"])){
//              $sql = "SELECT admin FROM cadet WHERE rin = (?)";
//              $stmt = $mysqli->prepare($sql);
//              if(!($stmt->bind_param( "i", $_SESSION["rin"] )))
//              {
//                echo "Prepared statement bind failed!";
//              }
//              $stmt->execute();
//              $result = $stmt->get_result();
//              $row = $result->fetch_assoc();    
//              if($row['admin'] === 1) {
//                echo "<a class=\"dropdown-item\" href=\"admin.php\">Admin</a>";
//              }
//            }
          ?>
          </div>
          </li>
          <form action="/index.php/cadet/logout" method="POST">
              <li class="nav-item">
                <button style="background-color:transparent;border:none;cursor:pointer;" class="nav-link" type="submit">Log Out</button>
              </li>          
          </form>
      </ul>
    </div>
  </nav>