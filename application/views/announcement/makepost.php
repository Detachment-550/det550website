<script src="/js/makepost.js"></script>

<body>
<div class="jumbotron container-fluid">
    <h1 class="display-4"> Make an Announcement </h1>
    <div class="card">
        <div class="card-body">
            <form action="/index.php/announcement/post" method="POST">
                <div class="form-group">
                    <label class="card-text" for="grouplist">Groups to notify (Ctl/Command Click to multiselect)</label><br>
                    <select id="grouplist" class="form-control" name="groups[]" multiple required>
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
