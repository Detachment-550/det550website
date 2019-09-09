<script src='<?php echo base_url("js/addCadet.js"); ?>'></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/admin.css"); ?>">

<body>
<div class="jumbotron jumbotron-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div id="memWrapper" class="card-body">
<!--                    TODO: Check to see if user exists before adding it in a validation form -->
                    <h5 id="memHeader" class="card-title">Add User</h5>
                    <?php echo form_open('cadet/add'); ?>
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input class="form-control" type="text" name="firstname" size="30" id="firstname" placeholder="Enter first name..." required/>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input class="form-control" type="text" name="lastname" size="30" id="lastname" placeholder="Enter last name..." required/>
                    </div>
                    <div class="form-group">
                        <label for="rin">RIN:</label>
                        <input class="form-control" type="text" name="rin" size="30" id="rin" placeholder="Enter Rensselaer ID number..." required/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input class="form-control" type="email" name="email" id="email" size="30" placeholder="Enter your email..." required/>
                    </div>
                    <div class="form-group">
                        <label for="admin">Administrative Privileges:</label>
                        <select name="admin" class="form-control" id="admin" required>
                            <option value="">Choose...</option>
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="rank">Rank:</label>
                        <select name="rank" id="rank" class="form-control" required>
                            <option value="">Choose...</option>
                            <option value="None">None</option>
                            <optgroup label="ROTC Ranks">
                                <option value="Cadet">Cadet</option>
                            </optgroup>
                            <optgroup label="Enlisted Ranks">
                                <option value="Airman Basic">Airman Basic</option>
                                <option value="Airman">Airman</option>
                                <option value="Airman First Class">Airman First Class</option>
                                <option value="Senior Airman">Senior Airman</option>
                                <option value="Staff Sergeant">Staff Sergeant</option>
                                <option value="Technical Sergeant">Technical Sergeant</option>
                                <option value="Master Sergeant">Master Sergeant</option>
                                <option value="Senior Master Sergeant">Senior Master Sergeant</option>
                                <option value="Chief Master Sergeant">Chief Master Sergeant</option>
                            </optgroup>
                            <optgroup label="Officer Ranks">
                                <option value="Second Lieutenant">Second Lieutenant</option>
                                <option value="First Lieutenant">First Lieutenant</option>
                                <option value="Captain">Captain</option>
                                <option value="Major">Major</option>
                                <option value="Lieutenant Colonel">Lieutenant Colonel</option>
                                <option value="Colonel">Colonel</option>
                                <option value="Brigadier General">Brigadier General</option>
                                <option value="Major General">Major General</option>
                                <option value="Lieutenant General">Lieutenant General</option>
                                <option value="General">General</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="class">AS Class:</label>
                        <select name="class" id="class" class="form-control" required>
                            <option value="">Choose...</option>
                            <option value="None">None</option>
                            <option value="AS100">AS100</option>
                            <option value="AS200">AS200</option>
                            <option value="AS250">AS250</option>
                            <option value="AS300">AS300</option>
                            <option value="AS400">AS400</option>
                            <option value="AS500">AS500</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="flight">Flight:</label>
                        <select name="flight" class="form-control" id="flight" required>
                            <option value="">Choose...</option>
                            <option value="None">None</option>
                            <option value="Alpha">Alpha</option>
                            <option value="Bravo">Bravo</option>
                            <option value="Charlie">Charlie</option>
                            <option value="Delta">Delta</option>
                            <option value="Echo">Echo</option>
                            <option value="Foxtrot">Foxtrot</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="question">Security Question:</label>
                        <select class="form-control" name="question" id="question" required>
                            <option value="">Choose...</option>
                            <option value="What was your childhood nickname?">What was your childhood nickname?</option>
                            <option value="What is the name of your favorite childhood friend?">What is the name of your favorite childhood friend?</option>
                            <option value="In what city or town did your mother and father meet?">In what city or town did your mother and father meet?</option>
                            <option value="What is your favorite team?">What is your favorite team?</option>
                            <option value="What is your favorite movie?">What is your favorite movie?</option>
                            <option value="What was your favorite sport in high school?">What was your favorite sport in high school?</option>
                            <option value="What was your favorite food as a child?">What was your favorite food as a child?</option>
                            <option value="What was the make and model of your first car?">What was the make and model of your first car?</option>
                            <option value="Who is your childhood sports hero?">Who is your childhood sports hero?</option>
                            <option value="In what town was your first job?">In what town was your first job?</option>
                            <option value="What was the name of the company where you had your first job?">What was the name of the company where you had your first job?</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="answer">Response:</label>
                        <input type="text" name="answer" id="answer" class="form-control" placeholder="Enter your security question answer..." required>
                    </div>
                    <div class="clearfix">
                        <label for="rfid">Card Input:</label>
                        <input class="form-control" type="text" id="rfid" placeholder="Select and scan RPI ID..." name="rfid"/>
                    </div><br>
                    <div class="clearfix">
                        <input class="btn btn-primary" type="submit" value="Add User" />
                        <input class="btn btn-secondary" type="reset" value="Reset"/>
                    </div>
                    </form><br>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Modify User Info</h5>
                    <?php echo form_open('cadet/select'); ?>
                    <button class="btn btn-warning" type="submit" name="submit">Modify Cadet Info</button>
                    </form>
                </div>
            </div><br>

            <div id="makeuser" class="card">
                <div id="memWrapper" class="card-body">
                    <h5 id="memHeader" class="card-title">Remove User</h5>
                    <?php echo form_open('cadet/remove'); ?>
                    <label for="remove">Select User</label>
                    <select name="remove" class="form-control" id="remove" required>
                        <option value="">Choose...</option>
                        <?php
                        usort($users, create_function('$a, $b', 'return strnatcasecmp($a->last_name, $b->last_name);'));
                        foreach($users as $user)
                        {
                            if($user->class != 'None' ) {
                                echo "<option value='" . $user->id . "'>" . $user->last_name . ", " . $user->first_name . "</option>";
                            }
                        }
                        ?>
                    </select><br>
                    <button class="btn btn-danger" name="submit" type="submit">Remove</button>
                    </form>
                    <br>
                    <h5 id="memHeader" class="card-title">Make User an Alumni</h5>
                    <?php echo form_open('alumni/create'); ?>
                    <div class="form-group">
                        <label for="transfer">Select User</label>
                        <select name="transfer" class="form-control" id="transfer" required>
                            <option value="">Choose...</option>
                            <?php
                            usort($users, create_function('$a, $b', 'return strnatcasecmp($a->last_name, $b->last_name);'));
                            foreach($users as $user)
                            {
                                if($user->class != 'None' ) {
                                    echo "<option value='" . $user->id . "'>" . $user->last_name . ", " . $user->first_name . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <button class="btn btn-danger" name="submit" type="submit">Transfer</button>
                    </form>
                </div>
            </div><br>

        </div>

        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Additional Admin Links</h4>
                    <?php echo form_open('announcement/remove'); ?>
                    <label for="announcement">Delete an Announcement</label>
                    <select name="announcement" id="announcement" class="form-control" required>
                        <option value="">Choose...</option>
                        <?php
                        foreach($announcements as $announcement)
                        {
                            echo "<option value='" . $announcement['uid'] . "'>" . $announcement['title'] . " " . $announcement['date'] . "</option>";
                        }
                        ?>
                    </select><br>
                    <button onClick="return confirm('Are you sure you want to delete this Announcement?')" class="btn btn-danger" type="submit" name="dannouncement">Delete</button>
                    </form><br><br>

                    <?php echo form_open('cadet/unlock'); ?>
                    <label for="cadet">Unlock Cadet Account</label>
                    <select name="user" id="cadet" class="form-control" required>
                        <option value="">Choose...</option>
                        <?php
                        usort($users, create_function('$a, $b', 'return strnatcasecmp($a->last_name, $b->last_name);'));
                        foreach($users as $user)
                        {
                            if($user->class != 'None' ) {
                                echo "<option value='" . $user->id . "'>" . $user->last_name . ", " . $user->first_name . "</option>";
                            }
                        }
                        ?>
                    </select><br>
                    <button class="btn btn-success" type="submit" name="unlock">Unlock</button>
                    </form><br><br>

                    <h6>Create/Modify/Delete a Group</h6>
                    <?php echo anchor('group/adminview', 'Edit Group', 'class="btn btn-primary"'); ?>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
