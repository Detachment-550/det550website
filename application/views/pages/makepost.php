<head>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ij0h6vcxvcacvu1l56udgaairzb672xtq1kktiizh2cpf4fe"></script>
    <script src="../../../js/makepost.js"></script>
</head>
<body> 
	<div class="jumbotron container-fluid">
		<h1 class="display-4"> Make an Announcement </h1>
		<div class="card">
			<div class="card-body">
<!--            TODO: Make making an announcement work -->
			<form class="makepost" action="sendpost.php" method="post">
				<label class="card-text" for="address">Groups to notify (Ctl/Command Click to multiselect)</label><br>
				<select id="grouplist" class="form-control" name="groups[]" multiple>
				<option value="null">No Groups [Default]</option>
				<?php
					foreach( $groups as $group ) 
                    {
						echo "<option value = '" . $group['label'] . "'>" . $group['label'] . "</option>";
					}
				?>
				</select><br>
				<p class="card-text">Title: <input class="form-control" type="text" name="postTitle"/>
				<p class="card-text">Subject: <input class="form-control" type="text" name="postSubject"/>
				<p class="card-text">Description: <textarea class="form-control" name="postBody" id="body"></textarea><br>
				<input class="btn btn-sm btn-primary" type="submit" name="postMade" value="Submit" onclick="saveBody()"/>
			</form>
	</div>
</body>