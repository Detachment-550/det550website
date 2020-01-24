<script src="/js/editannouncement.js"></script>

<h1 class="display-4"> Edit Your Announcement </h1>
<div class="card">
    <div class="card-body">
        <form action="/index.php/announcement/update" method="POST">
            <p class="card-text">Title: <input class="form-control" type="text" name="title" value="<?php echo $announcement->title; ?>" required/></p>
            <p class="card-text">Subject: <input class="form-control" type="text" name="subject" value="<?php echo $announcement->subject; ?>" required/></p>
            <p class="card-text">Description: <textarea class="form-control" name="body" id="body"><?php echo $announcement->body; ?></textarea></p><br>
            <input style="display: none;" value="<?php echo $announcement->id; ?>" name="announcement"/>
            <button class="btn btn-sm btn-primary" type="submit" name="submit">Save Changes</button>
        </form>
    </div>
</div>