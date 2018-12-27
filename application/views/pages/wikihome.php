<body>
  <div class="jumbotron container-fluid">
  	<h1 class="display-4">Documentation</h1>
    
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
        
<?php 
        // If the user is an admin allow them to add/remove wiki pages
        if( $admin == 1 )
        {
            echo "<div class='card' style='padding:10px;''>";
            echo "<h5 class='card-title'>Add/Delete Pages</h5>";
            echo "<p class='card-text'>";
            echo form_open('wiki/add');
            echo "<input placeholder='Enter wiki name...' name='name'>";
            echo " <button value='submit' class='btn btn-primary'>Add Wiki</button>";
            echo "</form><br>";
            echo form_open('wiki/remove');
            echo "<select name='wiki'>";
            
            foreach( $wikis as $wiki )
            {
              echo "<option value='" . $wiki['id'] . "'>" . $wiki['name'] . "</option>";
            }
            
            echo "</select>";
            echo " <button value='submit' class='btn btn-primary'>Remove Wiki</button>";
            echo "</form><br></p></div><br>";
        }
?>
        