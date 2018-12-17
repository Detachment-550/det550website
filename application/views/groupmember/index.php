<div class="pull-right">
	<a href="<?php echo site_url('groupmember/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>GroupID</th>
		<th>Rin</th>
		<th>Actions</th>
    </tr>
	<?php foreach($groupmember as $g){ ?>
    <tr>
		<td><?php echo $g['groupID']; ?></td>
		<td><?php echo $g['rin']; ?></td>
		<td>
            <a href="<?php echo site_url('groupmember/edit/'.$g['']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('groupmember/remove/'.$g['']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
