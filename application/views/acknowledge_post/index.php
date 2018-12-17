<div class="pull-right">
	<a href="<?php echo site_url('acknowledge_post/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>Rin</th>
		<th>Announcement Id</th>
		<th>Actions</th>
    </tr>
	<?php foreach($acknowledge_posts as $a){ ?>
    <tr>
		<td><?php echo $a['rin']; ?></td>
		<td><?php echo $a['announcement_id']; ?></td>
		<td>
            <a href="<?php echo site_url('acknowledge_post/edit/'.$a['rin']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('acknowledge_post/remove/'.$a['rin']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
