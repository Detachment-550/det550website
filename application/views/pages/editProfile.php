<head>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ij0h6vcxvcacvu1l56udgaairzb672xtq1kktiizh2cpf4fe"></script>
        <script src="../../../js/editProfile.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../css/editprofile.css">
</head>

  <div class="row">
    <div id="left">
      <div class="card">
        <div class="card-body">
          <form action="updateProfile.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" name="genInfo">
            <p><strong>Profile Picture: </strong></p><input type="file" placeholder="Enter name here" name="file"><br><br>
            <div>
                <strong>Primary Email:</strong><br>
                <input class="form-control" id="pemail" type="text" name="pemail" size="30" value="<?php // echo $cadet->getPrimEmail() ?>"/>
            </div><br>
            <div>
                <strong>Secondary Email:</strong><br>
                <input class="form-control" type="text" name="semail" size="30" value="<?php // echo $cadet->getSecEmail() ?>"/>
            </div><br>
            <div>
                <strong>Primary Phone:</strong><br>
                <input class="form-control" id="pphone" type="text" name="pphone" size="30" value="<?php // echo $cadet->getPrimPhone() ?>"/>
            </div><br>
            <div>
                <strong>Secondary Phone:</strong><br>
                <input class="form-control" type="text" name="sphone" size="30" value="<?php // echo $cadet->getSecPhone() ?>"/>
            </div><br>
            <div>
                <strong>GroupMe:</strong><br>
                <input class="form-control" type="text" name="groupme" size="30" value="<?php // echo $cadet->getGroupMe() ?>"/>
            </div><br>
            <div>
                <strong>Position:</strong><br>
                <input class="form-control"type="text" name="position" size="30" value="<?php // echo $cadet->getPosition() ?>"/>
            </div><br>
            <div>
                <strong>Major:</strong><br>
                <input class="form-control"type="text" name="major" size="30" value="<?php // echo $cadet->getMajor() ?>"/>
            </div><br>
            <button class="btn btn-sm btn-primary" type="reset">Reset</button>
            <button class="btn btn-sm btn-primary" type="submit" name="submit">Save Changes</button>
        </form><br>
      </div>
    </div>
  </div>


    <div id="right">
      <div class="card">
        <div class="card-body">
          <form action="updateProfile.php" method="post" enctype="multipart/form-data" onsubmit="return validatePass()" name="passChange">
            <h5 class="card-title">Change Password</h5>
            <div>
                <strong>Old Password:</strong><br>
                <input class="form-control" type="password" name="oldPass" id="oldPass" size="30"/>
            </div><br>
            <div>
                <strong>New Password:</strong><br>
                <input class="form-control" type="text" name="newPass" id="newPass" size="30"/>
            </div><br>
            <div>
                <strong>Verify Password:</strong><br>
                <input class="form-control" id="verPass" type="text" name="verPass" size="30"/>
            </div><br>
            <button class="btn btn-sm btn-primary" type="reset">Reset</button>
            <button class="btn btn-sm btn-primary" type="submit" name="updatepass">Change Password</button>
          </form><br>
            
        <a href="securityquestion.php" class="btn btn-sm btn-primary">Modify Security Question</a>
        </div>
      </div>
    </div>
    </div>
      
      <div id="bottom">
      <div class="card">
        <div class="card-body">
            <form action="editprofile.php" method="POST">
                <strong>Bio: </strong>
                <textarea id="cadetbio" name="cadetbio"><?php // echo $cadet->getBio(); ?></textarea><br>
                <button class="btn btn-sm btn-primary" type="submit">Save</button>
            </form><br>
 
            <form action="editprofile.php" method="POST">
                <strong>Air Force Goals: </strong>
                <textarea id="afgoals" name="afgoals"><?php // echo $cadet->getAirForceGoals(); ?></textarea><br>
                <button class="btn btn-sm btn-primary" type="submit">Save</button>
            </form><br>
            
            <form action="editprofile.php" method="POST">
                <strong>Personal Goals: </strong>
                <textarea id="pgoals" name="pgoals"><?php // echo $cadet->getPersonalGoals(); ?></textarea><br>
                <button class="btn btn-sm btn-primary" type="submit">Save</button>
            </form><br>
            
            <form action="editprofile.php" method="POST">
                <strong>Awards and Achievements: </strong>
                <textarea id="awards" name="awards"><?php // echo $cadet->getAwards(); ?></textarea><br>
                <button class="btn btn-sm btn-primary" type="submit">Save</button>
            </form><br>
        </div>
      </div>
    </div>
