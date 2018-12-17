<?php echo form_open('cadetgroup/edit/'.$cadetgroup['id'],array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="label" class="col-md-4 control-label">Label</label>
		<div class="col-md-8">
			<input type="text" name="label" value="<?php echo ($this->input->post('label') ? $this->input->post('label') : $cadetgroup['label']); ?>" class="form-control" id="label" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>
	
<?php echo form_close(); ?>