<body>
  <div class="jumbotron container-fluid">
  	<h1 class="display-4"> Documentation </h1>
  	  <div class="accordion" id="docs">
  		<?php
          foreach( $wikis as $wiki )
          {
              echo "<p><button style='width:100%;' class='btn btn-primary' type='button' data-toggle='collapse' data-target='#collapse" . $wiki['id'] . "' aria-expanded='false' aria-controls='collapse" . $wiki['id'] . "'>";
              echo $wiki['name'];
              echo "</button><div class='collapse' id='collapse" . $wiki['id'] . "'><div class='card card-body'>";
              echo $wiki['body'];
              echo form_open('wiki/edit');
              echo "<input style='display:none;' name='wiki' value='" . $wiki['id'] . "'><button class='btn btn-primary' type='submit'>Edit</button>";
              echo "</form></div></div></p>";
          }
          ?>