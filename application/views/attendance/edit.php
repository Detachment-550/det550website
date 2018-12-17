<?php echo form_open('attendance/edit/'.$attendance['rin'],array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="excused_absence" class="col-md-4 control-label">Excused Absence</label>
		<div class="col-md-8">
			<input type="checkbox" name="excused_absence" value="1" <?php echo ($attendance['excused_absence']==1 ? 'checked="checked"' : ''); ?> id='excused_absence' />
		</div>
	</div>
	<div class="form-group">
		<label for="time" class="col-md-4 control-label">Time</label>
		<div class="col-md-8">
			<input type="text" name="time" value="<?php echo ($this->input->post('time') ? $this->input->post('time') : $attendance['time']); ?>" class="form-control" id="time" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>
	
<?php echo form_close(); ?>