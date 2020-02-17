<div class="card">
    <div class="card-header">
        <h5 class="card-title">Update Wing Structure Picture</h5>
    </div>

    <div class="card-body">

        <?php echo form_open_multipart('cadet/uploadwingpic'); ?>
        <input type="file" name="wingpicture" required><br><br>
        <button class="btn btn-primary" type="submit" name="submit">Upload Picture</button><br><br>
        <img class="card-img-top" id="profile" alt="Wing Structure picture" src='<?php echo $picture_location; ?>'><br><br>

        </form>
    </div>
</div>
<style>
body
    {
        min-width: 500px;
    }
</style>
