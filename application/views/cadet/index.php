<div class="pull-right">
	<a href="<?php echo site_url('cadet/add'); ?>" class="btn btn-success">Add</a> 
</div>

<table class="table table-striped table-bordered">
    <tr>
		<th>Rin</th>
		<th>Admin</th>
		<th>Password</th>
		<th>FirstName</th>
		<th>Rank</th>
		<th>PrimaryEmail</th>
		<th>SecondaryEmail</th>
		<th>PrimaryPhone</th>
		<th>SecondaryPhone</th>
		<th>Flight</th>
		<th>Position</th>
		<th>GroupMe</th>
		<th>MiddleName</th>
		<th>LastName</th>
		<th>Rfid</th>
		<th>Major</th>
		<th>Bio</th>
		<th>AFGoals</th>
		<th>Awards</th>
		<th>PGoals</th>
		<th>Actions</th>
    </tr>
	<?php foreach($cadet as $c){ ?>
    <tr>
		<td><?php echo $c['rin']; ?></td>
		<td><?php echo $c['admin']; ?></td>
		<td><?php echo $c['password']; ?></td>
		<td><?php echo $c['firstName']; ?></td>
		<td><?php echo $c['rank']; ?></td>
		<td><?php echo $c['primaryEmail']; ?></td>
		<td><?php echo $c['secondaryEmail']; ?></td>
		<td><?php echo $c['primaryPhone']; ?></td>
		<td><?php echo $c['secondaryPhone']; ?></td>
		<td><?php echo $c['flight']; ?></td>
		<td><?php echo $c['position']; ?></td>
		<td><?php echo $c['groupMe']; ?></td>
		<td><?php echo $c['middleName']; ?></td>
		<td><?php echo $c['lastName']; ?></td>
		<td><?php echo $c['rfid']; ?></td>
		<td><?php echo $c['major']; ?></td>
		<td><?php echo $c['bio']; ?></td>
		<td><?php echo $c['AFGoals']; ?></td>
		<td><?php echo $c['awards']; ?></td>
		<td><?php echo $c['PGoals']; ?></td>
		<td>
            <a href="<?php echo site_url('cadet/edit/'.$c['rin']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('cadet/remove/'.$c['rin']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
	<?php } ?>
</table>
