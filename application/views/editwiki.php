<script src="/js/editwiki.js"></script>

<form action="/index.php/wiki/save" method="POST">
    <input type="text" style="display:none;" name="modifiedwiki" value='<?php echo $wiki['id']; ?>'/>
    <textarea id="wiki" name="savewiki"><?php echo $wiki['body']; ?></textarea>
    <br><button type="submit" name="save" class="btn btn-primary btn-sm">Save Changes</button>
</form>
