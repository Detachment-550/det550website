<div class="pull-right">
	<a href="<?php echo site_url('cadetgroup/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>ID</th>
		<th>Label</th>
		<th>Actions</th>
    </tr>
	<?php foreach($cadetgroup as $c){ ?>
    <tr>
		<td><?php echo $c['id']; ?></td>
		<td><?php echo $c['label']; ?></td>
		<td>
            <a href="<?php echo site_url('cadetgroup/edit/'.$c['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('cadetgroup/remove/'.$c['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
