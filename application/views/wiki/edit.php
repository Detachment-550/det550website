<?php echo form_open('wiki/edit/'.$wiki['name'],array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="body" class="col-md-4 control-label">Body</label>
		<div class="col-md-8">
			<textarea name="body" class="form-control" id="body"><?php echo ($this->input->post('body') ? $this->input->post('body') : $wiki['body']); ?></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>
	
<?php echo form_close(); ?>