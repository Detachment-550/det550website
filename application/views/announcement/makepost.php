<script src="<?php echo base_url("js/makepost.js"); ?>"></script>

<body> 
	<div class="jumbotron container-fluid">
		<h1 class="display-4"> Make an Announcement </h1>
		<div class="card">
			<div class="card-body">
                <?php echo form_open('announcement/post'); ?>

                <div class="form-group">
                    <label class="card-text" for="grouplist">Groups to notify (Ctl/Command Click to multiselect)</label><br>
                    <select id="grouplist" class="form-control" name="groups[]" multiple>
                        <option value="null">No Groups [Default]</option>
                        <?php
                        foreach( $groups as $group )
                        {
                            echo "<option value = '" . $group->id . "'>" . $group->description . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Title:</label>
                    <input class="form-control" type="text" id="title" name="title" required/>
                </div>

                <div class="form-group">
                    <label for="subject">Subject:</label>
                    <input class="form-control" type="text" name="subject" id="subject" required/>
                </div>

                <div class="form-group">
                    <label for="body">Description:</label>
                    <textarea class="form-control" name="body" id="body"></textarea>
                </div>

                <br>
                <button class="btn btn-sm btn-primary" type="submit" name="submit">Post Announcement</button>
			</form>
	</div>
</body>
