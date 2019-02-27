<script src="<?php echo base_url("js/group.js"); ?>"></script>

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
<body onload="select(1)">
<div class="jumbotron container-fluid">
  <div class="container">
    <h1 class="display-4"> Create Group </h1>
    <div class="card" id="Edit Groups">
      <div class="card-body">
        
        <?php echo form_open('cadetgroup/add'); ?>
          <h5 class="card-text">Create Group</h5>
          <label>Group Label:</label><br>
          <input type="text" name="label" id="groupname"><br>
          <label>Group Description (What other people see as the group name):</label><br>
          <input type="text" name="description" id="groupdes"><br><br>
          <button class="btn btn-sm btn-primary" type="submit" name="submit">Create Group</button>
        </form><br><br>
        
        <h5 class="card-text">Select Group</h5>
        
          <select id="selectgroup" name="group" onchange="select(this.value)" id="members">
          <?php
              foreach( $groups as $group )
              {
                  // Checks to see if a group was selected
                  if( $group['id'] == 1 )
                  {
                      echo "<option selected value='" . $group['id'] . "'> " . $group['description'] . "</option>";
                  }
                  else
                  {
                      echo "<option value='" . $group['id'] . "'> " . $group['description'] . "</option>";
                  }
              }
            ?>
          </select><br><br>

        <?php echo form_open('cadetgroup/addmembers'); ?>
          <h5 class="card-text" id="addcard">Add Members to </h5>
            <div class="selectcadets" style="height:100px;overflow-y: scroll;border: solid grey 1px;" id="ngroupmember">
            </div><br>
            <button class="btn btn-sm btn-primary" type="submit" name="submit">Add Members</button>
        </form><br>
        
        <?php echo form_open('cadetgroup/removemembers'); ?>
          <h5 class="card-text" id="removecard">Remove Members from </h5>
          <div class="selectcadets" style="height:100px;border: solid grey 1px;overflow-y: scroll;" id="groupmember">
          </div><br>
          <button class="btn btn-sm btn-primary" type="submit" name="submit">Remove Members</button>
        </form><br><br>


          <h5 class="card-text">Remove Group</h5>

          <?php echo form_open('cadetgroup/remove'); ?>
          <select id="selectgroup" name="group">
              <?php
              foreach( $groups as $group )
              {
                  // Doesn't allow admin or general members groups to be deleted
                  if( $group['label'] !== "admin" || $group['label'] !== "members" )
                  {
                      echo "<option value='" . $group['id'] . "'> " . $group['description'] . "</option>";
                  }
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
