<link rel="stylesheet" type="text/css" href="/css/rfid.css">

<h1 class="display-4"> Connect RFID </h1>
<div class="card">
    <div class="card-body">
        <form action="/index.php/cadet/save_rfid" method="POST">
            <div class="form-group">
                <label for="id">Select User:</label>
                <select name="id" id="id" class="form-control bootstrap-select" required>
                    <option value="">Choose...</option>
                    <?php
                        foreach ($users as $user) {
                            if ($user->class != 'None') {
                                echo '<option value="' . $user->id . '">' . $user->last_name . ', ' . $user->first_name . '</option>';
                            }
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="rfid">Scan Card:</label>
                <input class="form-control" type="text" id="rfid" name="rfid" placeholder="Click on input before scanning... " required/>
            </div>

            <button class="btn btn-primary" type="submit">Add Card</button>
        </form>
    </div>
</div>
