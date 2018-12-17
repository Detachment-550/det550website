<?php echo form_open('announcement/edit/'.$announcement['uid'],array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="title" class="col-md-4 control-label">Title</label>
		<div class="col-md-8">
			<input type="text" name="title" value="<?php echo ($this->input->post('title') ? $this->input->post('title') : $announcement['title']); ?>" class="form-control" id="title" />
		</div>
	</div>
	<div class="form-group">
		<label for="subject" class="col-md-4 control-label">Subject</label>
		<div class="col-md-8">
			<input type="text" name="subject" value="<?php echo ($this->input->post('subject') ? $this->input->post('subject') : $announcement['subject']); ?>" class="form-control" id="subject" />
		</div>
	</div>
	<div class="form-group">
		<label for="createdBy" class="col-md-4 control-label">CreatedBy</label>
		<div class="col-md-8">
			<input type="text" name="createdBy" value="<?php echo ($this->input->post('createdBy') ? $this->input->post('createdBy') : $announcement['createdBy']); ?>" class="form-control" id="createdBy" />
		</div>
	</div>
	<div class="form-group">
		<label for="date" class="col-md-4 control-label">Date</label>
		<div class="col-md-8">
			<input type="text" name="date" value="<?php echo ($this->input->post('date') ? $this->input->post('date') : $announcement['date']); ?>" class="form-control" id="date" />
		</div>
	</div>
	<div class="form-group">
		<label for="body" class="col-md-4 control-label">Body</label>
		<div class="col-md-8">
			<textarea name="body" class="form-control" id="body"><?php echo ($this->input->post('body') ? $this->input->post('body') : $announcement['body']); ?></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>
	
<?php echo form_close(); ?>