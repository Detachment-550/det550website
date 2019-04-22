<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/modifycadet.css"); ?>">

<body>
<div class="jumbotron jumbotron-fluid">
    <div class="card">
        <div class="card-body">
        <h4 class="card-title">Modify <?php echo $cadet['lastName']; ?>'s Info</h4>
      <?php echo form_open('cadet/modify'); ?>
        Administrative Privileges:<br>
            <input type="text" value="<?php echo $cadet['rin']; ?>" id="cadet" name="modify">
        <select name="admin">
          <option <?php if($cadet['admin'] == 0 ){ echo "selected"; } ?> value="0">No</option>
          <option <?php if($cadet['admin'] == 1 ){ echo "selected"; } ?> value="1">Yes</option>
        </select><br><br>
        Rank:<br>
        <select name="rank">
          <option <?php if($cadet['rank'] === "None" ){ echo "selected"; } ?> value="None">None</option>
          <optgroup label="ROTC Ranks">
            <option <?php if($cadet['rank'] === "AS100" ){ echo "selected"; } ?> value="AS100">AS100</option>
            <option <?php if($cadet['rank'] === "AS200" ){ echo "selected"; } ?> value="AS200">AS200</option>
            <option <?php if($cadet['rank'] === "AS250" ){ echo "selected"; } ?> value="AS250">AS250</option>
            <option <?php if($cadet['rank'] === "AS300" ){ echo "selected"; } ?> value="AS300">AS300</option>
            <option <?php if($cadet['rank'] === "AS350" ){ echo "selected"; } ?> value="AS350">AS350</option>
            <option <?php if($cadet['rank'] === "AS400" ){ echo "selected"; } ?> value="AS400">AS400</option>
            <option <?php if($cadet['rank'] === "AS500" ){ echo "selected"; } ?> value="AS500">AS500</option>
          </optgroup>
          <optgroup label="Enlisted Ranks">
            <option <?php if($cadet['rank'] === "Airman Basic" ){ echo "selected"; } ?> value="Airman Basic">Airman Basic</option>
            <option <?php if($cadet['rank'] === "Airman" ){ echo "selected"; } ?>value="Airman">Airman</option>
            <option <?php if($cadet['rank'] === "Airman First Class" ){ echo "selected"; } ?> value="Airman First Class">Airman First Class</option>
            <option <?php if($cadet['rank'] === "Senior Airman" ){ echo "selected"; } ?> value="Senior Airman">Senior Airman</option>
            <option <?php if($cadet['rank'] === "Staff Sergeant" ){ echo "selected"; } ?> value="Staff Sergeant">Staff Sergeant</option>
            <option <?php if($cadet['rank'] === "Technical Sergeant" ){ echo "selected"; } ?> value="Technical Sergeant">Technical Sergeant</option>
            <option <?php if($cadet['rank'] === "Master Sergeant" ){ echo "selected"; } ?> value="Master Sergeant">Master Sergeant</option>
            <option <?php if($cadet['rank'] === "Senior Master Sergeant" ){ echo "selected"; } ?> value="Senior Master Sergeant">Senior Master Sergeant</option>
            <option <?php if($cadet['rank'] === "Chief Master Sergeant" ){ echo "selected"; } ?> value="Chief Master Sergeant">Chief Master Sergeant</option>
          </optgroup>
          <optgroup label="Officer Ranks">
            <option <?php if($cadet['rank'] === "Second Lieutenant" ){ echo "selected"; } ?> value="Second Lieutenant">Second Lieutenant</option>
            <option <?php if($cadet['rank'] === "First Lieutenant" ){ echo "selected"; } ?> value="First Lieutenant">First Lieutenant</option>
            <option <?php if($cadet['rank'] === "Captain" ){ echo "selected"; } ?> value="Captain">Captain</option>
            <option <?php if($cadet['rank'] === "Major" ){ echo "selected"; } ?> value="Major">Major</option>
            <option <?php if($cadet['rank'] === "Lieutenant Colonel" ){ echo "selected"; } ?> value="Lieutenant Colonel">Lieutenant Colonel</option>
            <option <?php if($cadet['rank'] === "Colonel" ){ echo "selected"; } ?> value="Colonel">Colonel</option>
            <option <?php if($cadet['rank'] === "Brigadier General" ){ echo "selected"; } ?> value="Brigadier General">Brigadier General</option>
            <option <?php if($cadet['rank'] === "Major General" ){ echo "selected"; } ?> value="Major General">Major General</option>
            <option <?php if($cadet['rank'] === "Lieutenant General" ){ echo "selected"; } ?> value="Lieutenant General">Lieutenant General</option>
            <option <?php if($cadet['rank'] === "General" ){ echo "selected"; } ?> value="General">General</option>
          </optgroup>
          </select><br><br>
            Flight:<br>
              <select name="flight">
                <option <?php if($cadet['flight'] === "None" ){ echo "selected"; } ?> value="None">None</option>
                <option <?php if($cadet['flight'] === "Alpha" ){ echo "selected"; } ?> value="Alpha">Alpha</option>
                <option <?php if($cadet['flight'] === "Bravo" ){ echo "selected"; } ?> value="Bravo">Bravo</option>
                <option <?php if($cadet['flight'] === "Charlie" ){ echo "selected"; } ?> value="Charlie">Charlie</option>
                <option <?php if($cadet['flight'] === "Delta" ){ echo "selected"; } ?> value="Delta">Delta</option>
                <option <?php if($cadet['flight'] === "Echo" ){ echo "selected"; } ?> value="Echo">Echo</option>
                <option <?php if($cadet['flight'] === "Foxtrot" ){ echo "selected"; } ?> value="Foxtrot">Foxtrot</option>
              </select><br><br>
            <button class="btn btn-sm btn-primary" type="submit" name="submit">Modify <?php echo $cadet['lastName']; ?>'s Info</button>
        </form>
      </div>
    </div>
    </div>
</div>
</body>