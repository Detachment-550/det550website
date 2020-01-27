<script src="/js/modifycadet.js"></script>
<link rel="stylesheet" type="text/css" href="/css/modifycadet.css">

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Modify User's Info</h4>
        <form action="/index.php/cadet/modify" method="POST">

            <div class="form-group">
                <label for="modify">Select User</label>
                <select name="modify" id="modify" class="form-control bootstrap-select" onchange="selectuser(this.value)" required>
                    <option value="">Choose...</option>
                    <?php
                        foreach($users as $user)
                        {
                            if($user->class != 'None' ) {
                                echo "<option value='" . $user->id . "'>" . $user->last_name . ", " . $user->first_name . "</option>";
                            }
                        }
                    ?>
                    <br>
                </select>
            </div>

            <div id="hide">
                <div class="form-group">
                    <label for="cadet">Administrative Privileges:</label>
                    <select name="admin" class="form-control" id="admin" required>
                        <option value="no">No</option>
                        <option value="yes">Yes</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="rank">Rank:</label>
                    <select name="rank" id="rank" class="form-control bootstrap-select" required>
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

                <button class="btn btn-primary" type="submit" name="submit">Modify User's Info</button>
            </div>
        </form>
    </div>
</div>
