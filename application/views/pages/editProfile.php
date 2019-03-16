<script src="<?php echo base_url("js/editProfile.js"); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/editprofile.css"); ?>">

    <div class="jumbotron jumbotron-fluid">

      <div class="card">
        <div class="card-body">
            <?php echo form_open_multipart('cadet/uploadpic'); ?>
            <p><strong>Profile Picture: </strong></p>
            <img class="card-img-top" id="profile" alt="Profile picture" src='<?php echo base_url("images/" . $picture); ?>'><br><br>
            <input type="file" name="profilepicture"><br><br>
            <button class="btn btn-sm btn-primary" type="submit" name="submit">Upload Picture</button><br><br>
            </form>
        </div>
      </div>

    <div class="card">
        <div class="card-body">
            <?php echo form_open('cadet/saveprofile'); ?>
            <div>
                <strong>Email:</strong><br>
                <input class="form-control" id="pemail" type="text" name="pemail" size="30" value="<?php echo $cadet['primaryEmail']; ?>"/>
            </div><br>
            <div>
                <strong>Phone:</strong><br>
                <input class="form-control" id="pphone" type="number" name="pphone" size="30" value="<?php echo $cadet['primaryPhone']; ?>"/>
            </div><br>
            <div>
                <strong>Position:</strong><br>
                <input class="form-control"type="text" name="position" size="30" value="<?php echo $cadet['position']; ?>"/>
            </div><br>
            <div>
                <strong>Major:</strong><br>
                <input class="form-control"type="text" name="major" size="30" value="<?php echo $cadet['major']; ?>"/>
            </div><br>
            <strong>Personal Goals: </strong>
            <textarea id="pgoals" name="pgoals"><?php echo $cadet['PGoals']; ?></textarea><br>
            <strong>Bio: </strong>
            <textarea id="cadetbio" name="bio"><?php echo $cadet['bio']; ?></textarea><br>
            <strong>Air Force Goals: </strong>
            <textarea id="afgoals" name="afgoals"><?php echo $cadet['AFGoals']; ?></textarea><br>
            <strong>Awards and Achievements: </strong>
            <textarea id="awards" name="awards"><?php echo $cadet['awards']; ?></textarea><br>
            <button class="btn btn-sm btn-primary" type="submit" name="submit">Update Profile</button>
            </form><br>
      </div>
    </div>
<div class="card-body">
            <h5 class="card-title">GroupMe</h5>
            <div>
               
            <button type="submit" onclick="location.href='https://oauth.groupme.com/oauth/login_dialog?client_id=RtiKTbtfkzIn40Czo6uh6NsBgksBg8DAeTzoY9cEYM1aIjos'" class="btn btn-sm btn-primary">Link GroupMe</button>
                
            </div></form>
</div>
        <div class="card">
            <div class="card-body">
                <?php echo form_open('cadet/changepassword'); ?>
                <h5 class="card-title">Change Password</h5>
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
                <button class="btn btn-sm btn-primary" type="reset">Reset</button>
                <button class="btn btn-sm btn-primary" type="submit" name="updatepass">Change Password</button>
                </form><br>

                <?php echo form_open('cadet/security'); ?>
                <button type="submit" class="btn btn-sm btn-primary">Modify Security Question</button>
                </form>
            </div>
        </div>
  </div>
