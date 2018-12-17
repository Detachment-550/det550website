<?php echo form_open('groupmember/add',array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="groupID" class="col-md-4 control-label">GroupID</label>
		<div class="col-md-8">
			<input type="text" name="groupID" value="<?php echo $this->input->post('groupID'); ?>" class="form-control" id="groupID" />
		</div>
	</div>
	<div class="form-group">
		<label for="rin" class="col-md-4 control-label">Rin</label>
		<div class="col-md-8">
			<input type="text" name="rin" value="<?php echo $this->input->post('rin'); ?>" class="form-control" id="rin" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>

<?php echo form_close(); ?>