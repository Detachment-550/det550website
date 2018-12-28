<head>
  <title><?php echo $title; ?></title>
</head>
<style>
/* Styles for mobile */
@media (max-width: 600px) 
{
    .col-4, .col-8
    {
        -ms-flex: 100%;
        flex: 100%;
        max-width: 100%;
    }
    body
    {
        min-width: 400px;
    }
}
</style>
<body>
  <div class="jumbotron container-fluid">
    <h1 class="display-4"><?php echo $heading; ?></h1>
    <div class="container">
      <div class="row">
        <div class="col-4">
          <div class="card">
            <img class="card-img-top" alt="Profile picture" src='<?php echo base_url("images/" . $picture); ?>'>
          <div class="card-body">
            <p class="card-text">
            <strong>Contact Information: </strong><br>
            <strong>Email: </strong> <?php echo $cadet['primaryEmail']; ?><br>
            <strong>Phone Number: </strong> <?php echo $cadet['primaryPhone']; ?><br>
            <strong>Flight: </strong> <?php echo $cadet['flight']; ?><br>
            <strong>Position: </strong> <?php echo $cadet['position']; ?><br>
            <strong>Major: </strong> <?php echo $cadet['major']; ?><br>
            </p>
              <?php
                if( $myprofile === true)
                {
                    echo form_open('cadet/edit');
                    echo "<button class='btn btn-primary' role='button' href='editprofile.php'>Edit Page</button></form>";
                }
              ?>
            
          </div>
          </div>
        </div>

        <div class="col-8">
          <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rank:</h5>
                <p class="card-text"><?php echo $cadet['rank']; ?></p>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
                <h5 class="card-title">Bio:</h5>
                <p class="card-text"><?php echo $cadet['bio']; ?></p>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
                <h5 class="card-title">Awards and Achievements:</h5>
                <p class="card-text"><?php echo $cadet['awards']; ?></p>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
                <h5 class="card-title">Air Force Goals:</h5>
                <p class="card-text"><?php echo $cadet['AFGoals']; ?></p>
            </div>
          </div>

          <div class="card">
            <div class="card-body">
                <h5 class="card-title">Personal Goals:</h5>
                <p class="card-text"><?php echo $cadet['PGoals']; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
