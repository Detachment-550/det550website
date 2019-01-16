<head>
  <title><?php echo $title; ?></title>
</head>
<style>
/* Styles for mobile */
@media (max-width: 500px) 
{
    .card
    {
        width: 100%;
    }
    body
    {
        min-width: 400px;
    }
    .selectcadets
    {
        width: 100%;
    }
}
</style>
<body>
<div class="jumbotron container-fluid">
  <div class="container">
    <h1 class="display-4"> Create Group </h1>
    <div class="card" id="Edit Groups">
      <div class="card-body">
        
        <?php echo form_open('cadetgroup/add'); ?>
          <h5 class="card-text">Create Group</h5>
          <input type="text" name="label" id="groupname"><br><br>
          <button class="btn btn-sm btn-primary" type="submit" name="submit">Create Group</button>
        </form><br>
        
        <h5 class="card-text">Select Group</h5>
        
        <?php echo form_open('cadetgroup/modify'); ?>
          <select id="selectgroup" name="group">
          <?php
              foreach( $groups as $group )
              {
                  // Checks to see if a group was selected
                  if( isset($groupname) && $groupname['label'] === $group['label'] )
                  {
                      echo "<option selected value='" . $group['id'] . "'> " . $group['label'] . "</option>";      
                  }
                  else
                  {
                      echo "<option value='" . $group['id'] . "'> " . $group['label'] . "</option>";
                  }
              }
            ?>
          </select><br></br>
          <button class="btn btn-sm btn-primary" type="submit" name="submit">Select Group</button>
        </form><br>

        <?php echo form_open('cadetgroup/addmembers'); ?>
          <h5 class="card-text">Add Members to <?php if(isset($groupname)){ echo $groupname['label']; } ?></h5>
            <div class="selectcadets" style="height:100px;overflow-y: scroll;border: solid grey 1px;">
                <input type="text" style="display:none;" name="group" value="<?php if(isset($curgroup)){ echo $curgroup; } ?>">
            <?php
                if(isset($nonmembers))
                {
                    foreach( $nonmembers as $nonmember )
                    {
                        // Checks to see if this is cadre or admin not a cadet
                        if(strpos($nonmember['rank'], "AS") !== false)
                        {
                            echo "<input type='checkbox' name='cadets[]' value ='" . $nonmember['rin'] . "'> Cadet " . $nonmember['lastName'] . "</input><br>";
                        }
                        else if( strpos($nonmember['rank'], "None") !== false )
                        {
                            echo "<input type='checkbox' name='cadets[]' value ='" . $nonmember['rin'] . "'> " . $nonmember['firstName'] . " " . $nonmember['lastName'] . "</input><br>";
                        }
                        else
                        {
                            echo "<input type='checkbox' name='cadets[]' value ='" . $nonmember['rin'] . "'> " . $nonmember['rank'] . " " . $nonmember['lastName'] . "</input><br>";
                        }
                    }
                }
                else
                {
                    echo "Please select a group...";
                }
            ?>
            </div><br>
            <button class="btn btn-sm btn-primary" type="submit" name="submit">Add Members</button>
        </form><br>
        
        <?php echo form_open('cadetgroup/removemembers'); ?>
          <h5>Remove Members from <?php if(isset($groupname)){ echo $groupname['label']; } ?></h5>
          <div class="selectcadets" style="height:100px;border: solid grey 1px;overflow-y: scroll;">
              <input type="text" style="display:none;" name="group" value="<?php if(isset($curgroup)){ echo $curgroup; } ?>">
          <?php
                if(isset($members))
                {
                    foreach( $members as $member )
                    {
                        // Checks to see if this is cadre or admin not a cadet
                        if(strpos($member['rank'], "AS") !== false)
                        {
                            echo "<input type='checkbox' name='cadets[]' value ='" . $member['rin'] . "'> Cadet " . $member['lastName'] . "</input><br>";
                        }
                        else if( strpos($member['rank'], "None") !== false )
                        {
                            echo "<input type='checkbox' name='cadets[]' value ='" . $member['rin'] . "'> " . $member['firstName'] . " " . $member['lastName'] . "</input><br>";
                        }
                        else
                        {
                            echo "<input type='checkbox' name='cadets[]' value ='" . $member['rin'] . "'> " . $member['rank'] . " " . $member['lastName'] . "</input><br>";
                        }
                    }
                }
                else
                {
                    echo "Please select a group...";
                }
          ?>
          </div><br>
          <button class="btn btn-sm btn-primary" type="submit" name="submit">Remove Members</button>
        </form><br>


          <h5 class="card-text">Remove Group</h5>

          <?php echo form_open('cadetgroup/remove'); ?>
          <select id="selectgroup" name="group">
              <?php
              foreach( $groups as $group )
              {
                  echo "<option value='" . $group['id'] . "'> " . $group['label'] . "</option>";
              }
              ?>
          </select><br><br>
          <button class="btn btn-sm btn-primary" type="submit" name="submit">Delete Group</button>
          </form><br>

      </div>
    </div>
  </div>
</div>
</body>