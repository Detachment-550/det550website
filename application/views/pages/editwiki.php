<head>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ij0h6vcxvcacvu1l56udgaairzb672xtq1kktiizh2cpf4fe"></script>
    <script src="../../../js/editwiki.js"></script>
</head>
<?php echo form_open('wiki/save'); ?>
    <input type="text" style="display:none;" name="modifiedwiki" value='<?php echo $wiki['id']; ?>'/>
    <textarea id="wiki" name="savewiki"><?php echo $wiki['body']; ?></textarea>
    <br><button type="submit" name="save" class="btn btn-primary btn-sm">Save Changes</button>
</form>
