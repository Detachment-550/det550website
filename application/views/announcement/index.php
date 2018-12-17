<div class="pull-right">
	<a href="<?php echo site_url('announcement/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>Uid</th>
		<th>Title</th>
		<th>Subject</th>
		<th>CreatedBy</th>
		<th>Date</th>
		<th>Body</th>
		<th>Actions</th>
    </tr>
	<?php foreach($announcement as $a){ ?>
    <tr>
		<td><?php echo $a['uid']; ?></td>
		<td><?php echo $a['title']; ?></td>
		<td><?php echo $a['subject']; ?></td>
		<td><?php echo $a['createdBy']; ?></td>
		<td><?php echo $a['date']; ?></td>
		<td><?php echo $a['body']; ?></td>
		<td>
            <a href="<?php echo site_url('announcement/edit/'.$a['uid']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('announcement/remove/'.$a['uid']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
