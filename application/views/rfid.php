<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/rfid.css"); ?>">

<div class="jumbotron container-fluid">
    <h1 class="display-4"> Connect RFID </h1>
    <div class="card">
        <div class="card-body">
            <?php echo form_open('cadet/saverfid'); ?>

            <div class="form-group">
                <label for="rin">RIN:</label>
                <input class="form-control" type="text" id="rin" name="rin" placeholder="Enter your Rensselaer ID Number..." required/>
            </div>

            <div class="form-group">
                <label for="rfid">Scan Card:</label>
                <input class="form-control" type="text" id="rfid" name="rfid" placeholder="Click on input before scanning... " required/>
            </div>

            <button class="btn btn-primary" type="submit">Add Card</button>
            </form>
        </div>
    </div>
</div>
