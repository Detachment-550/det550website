<div class="pull-right">
	<a href="<?php echo site_url('attendance/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>Rin</th>
		<th>Eventid</th>
		<th>Excused Absence</th>
		<th>Time</th>
		<th>Actions</th>
    </tr>
	<?php foreach($attendance as $a){ ?>
    <tr>
		<td><?php echo $a['rin']; ?></td>
		<td><?php echo $a['eventid']; ?></td>
		<td><?php echo $a['excused_absence']; ?></td>
		<td><?php echo $a['time']; ?></td>
		<td>
            <a href="<?php echo site_url('attendance/edit/'.$a['rin']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('attendance/remove/'.$a['rin']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
