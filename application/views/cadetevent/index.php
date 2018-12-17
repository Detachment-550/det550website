<div class="pull-right">
	<a href="<?php echo site_url('cadetevent/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>EventID</th>
		<th>Name</th>
		<th>Date</th>
		<th>Pt</th>
		<th>Llab</th>
		<th>Actions</th>
    </tr>
	<?php foreach($cadetevent as $c){ ?>
    <tr>
		<td><?php echo $c['eventID']; ?></td>
		<td><?php echo $c['name']; ?></td>
		<td><?php echo $c['date']; ?></td>
		<td><?php echo $c['pt']; ?></td>
		<td><?php echo $c['llab']; ?></td>
		<td>
            <a href="<?php echo site_url('cadetevent/edit/'.$c['eventID']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('cadetevent/remove/'.$c['eventID']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
