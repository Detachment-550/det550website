<script src="<?php echo base_url("js/sendemail.js"); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/sendemail.css"); ?>">

<div class="jumbotron container-fluid">
    <h1 class="display-4"> Send an Email </h1>
    <div class="card">
        <div class="card-body">
            <?php echo form_open('email/send'); ?>
            <div class="form-group">
                <label class="card-text" for="grouplist"><b>Mail Groups (Ctl/Command Click to multiselect)</b></label>
                <select id="grouplist" class="form-control" name="groups[]" multiple>
                    <option value="null" selected>No Groups [Default]</option>
                    <?php
                    // Lists groups available to be emailed
                    foreach( $groups as $group )
                    {
                        echo "<option value = '" . $group->id . "'>" . $group->description . "</option>";
                    }
                    ?>
                </select>
            </div>


            <div class="form-group">
                <label class="card-text" for="address"><b>To Address (Add ; after each email address)</b></label>
                <input class="form-control" type="text" id="address" name="to">
            </div>


            <div class="form-group">
                <label class="card-text" for="subject"><b>Subject</b></label>
                <input class="form-control" type="text" name="subject" id="subject" required>
            </div>


            <div class="form-group">
                <label class="card-text" for="body"><b>Body</b></label>
                <textarea class="form-control" type="text" name="body" id="body"></textarea>
            </div>

            <button class="btn btn-sm btn-primary" type="submit" name="send" onclick="sendBody()" value="Send">Send</button>
            </form><br>
        </div>
    </div>
</div>
