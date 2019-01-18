<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/attendance.css"); ?>">

<body>
  <div class="jumbotron container-fluid">
  	<h1 class="display-4"> Events </h1>
  	<div class="container">
      <div class="row">
        <div class="col-6">
            <div class="card" style="margin: auto;padding: 10px;">
                <h5 class="card-title">Create an Event</h5>
                    <?php echo form_open('cadetevent/add'); ?>
                    <label for=title><b>Title: </b></label><br><input class="form-control" type="text" name="name"/><br>
                    <label for=date><b>Date: </b></label><br><input class="form-control" type="datetime-local" name="date"/><br>
                    <label for=mandatory><b>Event Type: </b></label><br>
                    <select name="type"><option value="nonpmt">Non PMT</option><option value="pt">PT</option><option value="llab">LLAB</option></select><br><br> 
                    <button class="btn btn-sm btn-primary" type="submit" value="Submit" name="eventMade">Submit</button>
  			   </form>
            </div>
          </div>
          
          <div class="col-6">
    	    <div class="card" style="margin: auto;width: 100%;padding: 10px;">
    			<h5 class="card-title"> Select Event</h5>
                <?php echo form_open('attendance/attendees'); ?>
    			<select class="form-control" name="event">
    				<?php
    				foreach($events as $event) 
                    {
                        echo '<option value="' . $event['eventID'] . '">' . $event['name'] . '</option>';
    				}
    				?>
    			</select><br>
    			<button class="btn btn-sm btn-primary" type="submit" value="submit" name="selectevent">View Attendees</button><br><br>
    			</form>
                   		  </div>
      	</div>
      </div>
    </div>
</div>
</body>