<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/modifycadet.css"); ?>">

<body>
<div class="jumbotron jumbotron-fluid">
    <div class="card">
        <div class="card-body">
        <h4 class="card-title">Modify <?php echo $cadet['lastName']; ?>'s Info</h4>
          <h6>Current Info:</h6>
          <strong>Admin: </strong>
          <?php
          if($cadet['admin'] === 1 )
          {
              echo "Yes";
          }
          else
          {
              echo "No";
          }
          ?><br>
          <strong>Rank: </strong> <?php echo $cadet['rank']; ?><br>
          <strong>Flight: </strong> <?php echo $cadet['flight']; ?><br><br>
      <?php echo form_open('cadet/changeinfo'); ?>
        Administrative Privileges:<br>
        <select name="admin">
          <option value="0">No</option>
          <option value="1">Yes</option>
        </select><br><br>
        Rank:<br>
        <select name="rank">
          <option value="None">None</option>
          <optgroup label="ROTC Ranks">
            <option value="AS100">AS100</option>
            <option value="AS200">AS200</option>
            <option value="AS250">AS250</option>
            <option value="AS300">AS300</option>
            <option value="AS350">AS350</option>
            <option value="AS400">AS400</option>
            <option value="AS500">AS500</option>
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
          </select><br><br>
            Flight:<br>
              <select name="flight">
                <option value="None">None</option>
                <option value="Alpha">Alpha</option>
                <option value="Bravo">Bravo</option>
                <option value="Charlie">Charlie</option>
                <option value="Delta">Delta</option>
                <option value="Echo">Echo</option>
                <option value="Foxtrot">Foxtrot</option>
              </select><br><br>
            <button class="btn btn-sm btn-primary" type="submit" name="submit">Modify <?php echo $cadet['lastName']; ?>'s Info</button>
        </form>
      </div>
    </div>
    </div>
</div>
</body>