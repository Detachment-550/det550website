<head>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ij0h6vcxvcacvu1l56udgaairzb672xtq1kktiizh2cpf4fe"></script>
        <script src="<?php echo base_url("js/sendemail.js"); ?>"></script>
</head>
<body>
<div class="jumbotron container-fluid">
  <h1 class="display-4"> Send an Email </h1>
    <div class="card">
      <div class="card-body">
        <?php echo form_open('email/send'); ?>
            <label class="card-text" for="address"><b>Mail Groups (Ctl/Command Click to multiselect)</b></label><br>
            <select id="grouplist" class="form-control" name="groups[]" multiple>
            <option value="null">No Groups [Default]</option>
            <?php
                // Lists groups available to be emailed
                foreach( $groups as $group ) 
                {
                    echo "<option value = '" . $group['id'] . "'>" . $group['label'] . "</option>";
                }
            ?>
            </select><br>
            <label class="card-text" for="address"><b>To Address (Add ; after each email address)</b></label><br>
            <input class="form-control" type="text" name="to"><br>
            <label class="card-text" for="subject"><b>Subject</b></label><br>
            <input class="form-control" type="text" name="subject" required><br>
            <label class="card-text" for="body"><b>Body</b></label><br>
            <textarea class="form-control" type="text" name="body" id="body"></textarea><br>
            <button class="btn btn-sm btn-primary" type="submit" name="send" onclick="sendBody()" value="Send">Send</button>
        </form><br>
      </div>
    </div>
</div>
        