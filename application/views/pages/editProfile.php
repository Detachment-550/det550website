<head>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ij0h6vcxvcacvu1l56udgaairzb672xtq1kktiizh2cpf4fe"></script>
        <script src="../../../js/editProfile.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../css/editprofile.css">
</head>

  <div class="row">
    <div id="left">
      <div class="card">
        <div class="card-body">
            <?php echo form_open_multipart('cadet/uploadpic'); ?>
            <p><strong>Profile Picture: </strong></p><input type="file" name="profilepicture"><br><br>
            <button class="btn btn-sm btn-primary" type="submit" name="submit">Upload Picture</button><br><br>
            </form>
            <?php echo form_open('cadet/savegeninfo'); ?>
            <div>
                <strong>Primary Email:</strong><br>
                <input class="form-control" id="pemail" type="text" name="pemail" size="30" value="<?php echo $cadet['primaryEmail']; ?>"/>
            </div><br>
            <div>
                <strong>Secondary Email:</strong><br>
                <input class="form-control" type="text" name="semail" size="30" value="<?php echo $cadet['secondaryEmail']; ?>"/>
            </div><br>
            <div>
                <strong>Primary Phone:</strong><br>
                <input class="form-control" id="pphone" type="text" name="pphone" size="30" value="<?php echo $cadet['primaryPhone']; ?>"/>
            </div><br>
            <div>
                <strong>Secondary Phone:</strong><br>
                <input class="form-control" type="text" name="sphone" size="30" value="<?php echo $cadet['secondaryPhone']; ?>"/>
            </div><br>
            <div>
                <strong>GroupMe:</strong><br>
                <input class="form-control" type="text" name="groupme" size="30" value="<?php echo $cadet['groupMe']; ?>"/>
            </div><br>
            <div>
                <strong>Position:</strong><br>
                <input class="form-control"type="text" name="position" size="30" value="<?php echo $cadet['position']; ?>"/>
            </div><br>
            <div>
                <strong>Major:</strong><br>
                <input class="form-control"type="text" name="major" size="30" value="<?php echo $cadet['major']; ?>"/>
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
    </div>
      
      <div id="bottom">
      <div class="card">
        <div class="card-body">
            <?php echo form_open('cadet/savebio'); ?>
                <strong>Bio: </strong>
                <textarea id="cadetbio" name="bio"><?php echo $cadet['bio']; ?></textarea><br>
                <button class="btn btn-sm btn-primary" type="submit">Save</button>
            </form><br>
 
            <?php echo form_open('cadet/saveafgoals'); ?>
                <strong>Air Force Goals: </strong>
                <textarea id="afgoals" name="afgoals"><?php echo $cadet['AFGoals']; ?></textarea><br>
                <button class="btn btn-sm btn-primary" type="submit">Save</button>
            </form><br>
            
            <?php echo form_open('cadet/savepgoals'); ?>
                <strong>Personal Goals: </strong>
                <textarea id="pgoals" name="pgoals"><?php echo $cadet['PGoals']; ?></textarea><br>
                <button class="btn btn-sm btn-primary" type="submit">Save</button>
            </form><br>
            
            <?php echo form_open('cadet/saveawards'); ?>
                <strong>Awards and Achievements: </strong>
                <textarea id="awards" name="awards"><?php echo $cadet['awards']; ?></textarea><br>
                <button class="btn btn-sm btn-primary" type="submit">Save</button>
            </form><br>
        </div>
      </div>
    </div>
