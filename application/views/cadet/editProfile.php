<script src="/application/third_party/jQuery-Mask-Plugin/dist/jquery.mask.min.js"></script>
<link rel="stylesheet" type="text/css" href="/css/editprofile.css">

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Update Profile Picture</h5>
        </div>

        <div class="card-body">
            <div class="alert alert-warning" role="alert" style="display: <?php if($error !== NULL) { echo "block";} else {echo "none";} ?>">
                <?php echo $error; ?>
            </div>
            <?php echo form_open_multipart('cadet/uploadpic'); ?>
            <img class="card-img-top" id="profile" alt="Profile picture" src='<?php echo $picture; ?>'><br><br>
            <input type="file" name="profilepicture" required><br><br>
            <button class="btn btn-primary" type="submit" name="submit">Upload Picture</button><br><br>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Update Profile Information</h5>
        </div>
        <div class="card-body">
            <form action="/index.php/cadet/saveprofile" method="POST" onsubmit="return validate();">
                <div>
                    <strong>Email:</strong><br>
                    <input class="form-control" id="pemail" type="email" name="pemail" size="30" value="<?php echo $user->email; ?>"/>
                </div><br>
                <div>
                    <strong>Phone:</strong><br>
                    <input class="form-control" id="phone" type="text" name="phone" value="<?php echo $user->phone; ?>"/>
                    <input style="display: none;" id="pphone" type="number" name="pphone" value="<?php echo $user->phone; ?>"/>
                </div><br>
                <div>
                    <strong>Position:</strong><br>
                    <input class="form-control"type="text" name="position" size="30" value="<?php echo $user->position; ?>"/>
                </div><br>
                <div>
                    <strong>Major:</strong><br>
                    <input class="form-control"type="text" name="major" size="30" value="<?php echo $user->major; ?>"/>
                </div><br>
                <strong>Personal Goals: </strong>
                <textarea id="pgoals" name="pgoals"><?php echo $user->goals; ?></textarea><br>
                <strong>Bio: </strong>
                <textarea id="cadetbio" name="bio"><?php echo $user->bio; ?></textarea><br>
                <strong>Air Force Goals: </strong>
                <textarea id="afgoals" name="afgoals"><?php echo $user->afgoals; ?></textarea><br>
                <strong>Awards and Achievements: </strong>
                <textarea id="awards" name="awards"><?php echo $user->awards; ?></textarea><br>
                <button class="btn btn-primary" type="submit" name="submit">Update Profile</button>
            </form><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">GroupMe</h5>
        </div>

        <div class="card-body">
            <div>
                <button type="submit" onclick="location.href='https://oauth.groupme.com/oauth/login_dialog?client_id=RtiKTbtfkzIn40Czo6uh6NsBgksBg8DAeTzoY9cEYM1aIjos'" class="btn btn-primary">
                    Link GroupMe
                </button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Change Password</h5>
        </div>

        <div class="card-body">
            <form action="/index.php/cadet/changepassword" method="POST">
                <div>
                    <strong>Old Password:</strong><br>
                    <input class="form-control" type="password" name="oldpass" id="oldpass" size="30"/>
                </div><br>
                <div>
                    <strong>New Password:</strong><br>
                    <input class="form-control" type="text" name="newpass" id="newpass" size="30"/>
                </div><br>
                <div>
                    <strong>Verify Password:</strong><br>
                    <input class="form-control" id="verpass" type="text" name="verpass" size="30"/>
                </div><br>
                <button class="btn btn-primary" type="reset">Reset</button>
                <button class="btn btn-primary" type="submit" name="updatepass">Change Password</button>
            </form>
            <br>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Change Security Question</h5>
        </div>

        <div class="card-body">
            <form action="/index.php/cadet/security" method="POST">
                <button type="submit" class="btn btn-primary">Modify Security Question</button>
            </form>
        </div>
    </div>

<script src="/js/editProfile.js"></script>
