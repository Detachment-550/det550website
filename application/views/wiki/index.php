<div class="pull-right">
	<a href="<?php echo site_url('wiki/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>Name</th>
		<th>Body</th>
		<th>Actions</th>
    </tr>
	<?php foreach($wiki as $w){ ?>
    <tr>
		<td><?php echo $w['name']; ?></td>
		<td><?php echo $w['body']; ?></td>
		<td>
            <a href="<?php echo site_url('wiki/edit/'.$w['name']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('wiki/remove/'.$w['name']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
