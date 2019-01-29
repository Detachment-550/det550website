<head>
    <script src="<?php echo base_url("js/editwiki.js"); ?>"></script>
</head>
<?php echo form_open('wiki/save'); ?>
    <input type="text" style="display:none;" name="modifiedwiki" value='<?php echo $wiki['id']; ?>'/>
    <textarea id="wiki" name="savewiki"><?php echo $wiki['body']; ?></textarea>
    <br><button type="submit" name="save" class="btn btn-primary btn-sm">Save Changes</button>
</form>
