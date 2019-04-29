<script src="<?php echo base_url("js/makepost.js"); ?>"></script>

<body> 
	<div class="jumbotron container-fluid">
		<h1 class="display-4"> Make an Announcement </h1>
		<div class="card">
			<div class="card-body">
                <?php echo form_open('announcement/post'); ?>
				<label class="card-text" for="address">Groups to notify (Ctl/Command Click to multiselect)</label><br>
				<select id="grouplist" class="form-control" name="groups[]" multiple>
				<option value="null">No Groups [Default]</option>
				<?php
					foreach( $groups as $group ) 
                    {
						echo "<option value = '" . $group->id . "'>" . $group->description . "</option>";
					}
				?>
				</select><br>
                <p class="card-text">Title: <input class="form-control" type="text" name="title" required/></p>
                <p class="card-text">Subject: <input class="form-control" type="text" name="subject" required/></p>
                <p class="card-text">Description: <textarea class="form-control" name="body" id="body"></textarea></p><br>
                <button class="btn btn-sm btn-primary" type="submit" name="submit">Post Announcement</button>
			</form>
	</div>
</body>
