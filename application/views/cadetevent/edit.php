<?php echo form_open('cadetevent/edit/'.$cadetevent['eventID'],array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="name" class="col-md-4 control-label">Name</label>
		<div class="col-md-8">
			<input type="text" name="name" value="<?php echo ($this->input->post('name') ? $this->input->post('name') : $cadetevent['name']); ?>" class="form-control" id="name" />
		</div>
	</div>
	<div class="form-group">
		<label for="date" class="col-md-4 control-label">Date</label>
		<div class="col-md-8">
			<input type="text" name="date" value="<?php echo ($this->input->post('date') ? $this->input->post('date') : $cadetevent['date']); ?>" class="form-control" id="date" />
		</div>
	</div>
	<div class="form-group">
		<label for="pt" class="col-md-4 control-label">Pt</label>
		<div class="col-md-8">
			<input type="text" name="pt" value="<?php echo ($this->input->post('pt') ? $this->input->post('pt') : $cadetevent['pt']); ?>" class="form-control" id="pt" />
		</div>
	</div>
	<div class="form-group">
		<label for="llab" class="col-md-4 control-label">Llab</label>
		<div class="col-md-8">
			<input type="text" name="llab" value="<?php echo ($this->input->post('llab') ? $this->input->post('llab') : $cadetevent['llab']); ?>" class="form-control" id="llab" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>
	
<?php echo form_close(); ?>