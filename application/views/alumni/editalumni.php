<script src="<?php echo base_url("js/editalumni.js"); ?>"></script>

<div class="jumbotron">
    <h1 class="display-4">Add/Edit Alumni</h1>
    <div class="card">
        <div class="card-body">
            <h3>Add Alumni</h3>
            <?php echo form_open('alumni/addalum'); ?>
            <div class="form-group">
                <label for="first">First Name</label>
                <input type="text" id="first" name="firstname" required class="form-control" placeholder="Enter first name..."/>
            </div>
            <div class="form-group">
                <label for="last">Last Name</label>
                <input type="text" id="last" required name="lastname" class="form-control" placeholder="Enter last name..."/>
            </div>
            <div class="form-group">
                <label for="rank">Rank</label>
                <select name="rank" id="rank" required class="form-control">
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
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required class="form-control" placeholder="Enter email..."/>
            </div>
<!--            TODO: Use input masking here -->
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="number" id="phone" name="phone" required class="form-control" placeholder="Enter phone number..."/>
            </div>
            <div class="form-group">
                <label for="major">Major</label>
                <input type="text" id="major" name="major" required class="form-control" placeholder="Enter college major..."/>
            </div>
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" id="position" name="position" required class="form-control" placeholder="Enter AFSC..."/>
            </div>
            <button type="reset" class="btn btn-secondary">Reset</button>
            <button type="submit" class="btn btn-primary">Add Alumni</button>
            </form>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-body">
            <h3>Edit Alumni</h3>
            <?php echo form_open('alumni/edit'); ?>
            <div class="form-group">
                <label for="alum">Select Alumni</label>
                <select name="alumni" id="alum" required class="form-control" onchange="selectalum(this.value)">
                    <option value="">Choose...</option>
                    <?php
                        foreach ($alumni as $alumnus)
                        {
                            echo "<option value='" . $alumnus['alumni_id'] . "'>" . $alumnus['rank'] . " " . $alumnus['last_name'] . "</option>";
                        }
                    ?>
                </select>
            </div>
            <div id="hide" style="display: none;">
                <div class="form-group">
                    <label for="efirst">First Name</label>
                    <input type="text" id="efirst" name="firstname" required class="form-control" placeholder="Enter first name..."/>
                </div>
                <div class="form-group">
                    <label for="elast">Last Name</label>
                    <input type="text" id="elast" required name="lastname" class="form-control" placeholder="Enter last name..."/>
                </div>
                <div class="form-group">
                    <label for="erank">Rank</label>
                    <select name="rank" id="erank" required class="form-control">
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
                    <label for="eemail">Email</label>
                    <input type="email" id="eemail" name="email" required class="form-control" placeholder="Enter email..."/>
                </div>
                <!--            TODO: Use input masking here -->
                <div class="form-group">
                    <label for="ephone">Phone</label>
                    <input type="number" id="ephone" name="phone" required class="form-control" placeholder="Enter phone number..."/>
                </div>
                <div class="form-group">
                    <label for="emajor">Major</label>
                    <input type="text" id="emajor" name="major" required class="form-control" placeholder="Enter college major..."/>
                </div>
                <div class="form-group">
                    <label for="eposition">Position</label>
                    <input type="text" id="eposition" name="position" required class="form-control" placeholder="Enter AFSC..."/>
                </div>
                <button type="reset" class="btn btn-secondary">Reset</button>
                <button type="submit" class="btn btn-primary">Update Alumni</button>
                </form>
            </div>

        </div>
    </div>
</div>
