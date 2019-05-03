<script src="<?php echo base_url("js/group.js"); ?>"></script>
<link type="text/css" href="<?php echo base_url('css/group.css'); ?>">

<!--TODO: Fix ajax on this page to work with new auth system -->
<body onload="select(1)">
<div class="jumbotron container-fluid">
  <div class="container">
    <h1 class="display-4"> Create Group </h1>
    <div class="card" id="Edit Groups">
      <div class="card-body">
        
        <?php echo form_open('cadetgroup/add'); ?>
          <h5 class="card-text">Create Group</h5>
          <div class="form-group">
              <label for="groupname">Group Label:</label>
              <input type="text" name="label" id="groupname" class="form-control" placeholder="Enter the group's label" required>
          </div>

          <div class="form-group">
              <label>Group Description:</label>
              <input type="text" name="description" id="groupdes" class="form-control" placeholder="What other people see as the group name" required>
          </div>

          <button class="btn btn-primary" type="submit" name="submit">Create Group</button>
        </form><br><br>

          <h5 class="card-text">Modify Group</h5>
          <div class="form-group">
              <label for="selectgroup">Select Group</label>
              <select id="selectgroup" name="group" onchange="select(this.value)" id="members" class="form-control" required>
                  <option value="">Choose...</option>
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
              </select>
          </div>


        <?php echo form_open('cadetgroup/addmembers'); ?>
          <label for="ngroupmember">Add Members</label>
            <div class="selectcadets" id="ngroupmember">
            </div><br>
            <button class="btn btn-sm btn-primary" type="submit" name="submit">Add Members</button>
        </form><br>
        
        <?php echo form_open('cadetgroup/removemembers'); ?>
          <label for="groupmember">Remove Members</label>
          <div class="selectcadets" id="groupmember">
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
                  if( $group['label'] !== "admin" && $group['label'] !== "members" )
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
