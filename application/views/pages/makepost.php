<head>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ij0h6vcxvcacvu1l56udgaairzb672xtq1kktiizh2cpf4fe"></script>
    <script src="<?php echo base_url("js/makepost.js"); ?>"></script>
</head>
<body> 
	<div class="jumbotron container-fluid">
		<h1 class="display-4"> Make an Announcement </h1>
		<div class="card">
			<div class="card-body">
<!--            TODO: Make making an announcement work -->
                <?php echo form_open('announcement/post'); ?>
				<label class="card-text" for="address">Groups to notify (Ctl/Command Click to multiselect)</label><br>
				<select id="grouplist" class="form-control" name="groups[]" multiple>
				<option value="null">No Groups [Default]</option>
				<?php
					foreach( $groups as $group ) 
                    {
						echo "<option value = '" . $group['id'] . "'>" . $group['label'] . "</option>";
					}
				?>
				</select><br>
				<p class="card-text">Title: <input class="form-control" type="text" name="title"/>
				<p class="card-text">Subject: <input class="form-control" type="text" name="subject"/>
				<p class="card-text">Description: <textarea class="form-control" name="description" id="body"></textarea><br>
				<input class="btn btn-sm btn-primary" type="submit" name="submit" value="submit" onclick="saveBody()"/>
			</form>
	</div>
</body>