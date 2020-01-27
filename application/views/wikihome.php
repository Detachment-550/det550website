<link rel="stylesheet" type="text/css" href="/css/wiki.css">

<body>
<h1 class="display-4">Documentation</h1>

<div class="accordion" id="docs">
    <?php
        foreach( $wikis as $wiki )
        {
            echo "<p><button style='width:100%;' class='btn btn-primary' type='button' data-toggle='collapse' data-target='#collapse" .
                $wiki['id'] . "' aria-expanded='false' aria-controls='collapse" . $wiki['id'] . "'>";
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
            echo "<div class='form-group'>";
            echo "<label for='name'>Add Wiki Page</label>";
            echo "<p class='card-text'>";
            echo form_open('wiki/add');
            echo "<input placeholder='Enter wiki name...' class='form-control' name='name' id='name' required></div>";
            echo " <button type='submit' class='btn btn-success'>Add Wiki</button>";
            echo "</form><br>";
            echo form_open('wiki/remove');
            echo "<div class='form-group'>";
            echo "<label for='wiki'>Remove Wiki Page</label>";
            echo "<select name='wiki' id='wiki' class='form-control' required><option value=''>Choose...</option>";

            foreach( $wikis as $wiki )
            {
                echo "<option value='" . $wiki['id'] . "'>" . $wiki['name'] . "</option>";
            }

            echo "</select></div>";
            echo " <button type='submit' class='btn btn-danger'>Remove Wiki</button>";
            echo "</form><br></p></div><br>";
        }
    ?>
