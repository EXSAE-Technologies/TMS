<?php

require_once("../includes/header.php");

$users = new Users();
$userObjects = $users->get_all_users();
?>

<table class="table table-striped">
	<tr>
		<th>ID</th>
		<th>Username</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Status</th>
		<th></th>
	</tr>
	<?php
	foreach($userObjects as $userObject){
	?>
	<tr>
		<td><?php echo $userObject[0]; ?></td>
		<td><?php echo $userObject[1]; ?></td>
		<td><?php echo $userObject[2]; ?></td>
		<td><?php echo $userObject[3]; ?></td>
		<td><?php echo $userObject[8]; ?></td>
		<td>
			<?php
			if ($userObject[8] == "ACTIVATED") {
			?>
				<a href="" class="btn btn-warning">deactivate</a>
			<?php
			} else {
			?>
				<a href="" class="btn btn-success">activate</a>
			<?php
			}
			?>
			<a href="" class="btn btn-primary">edit</a>
			<a href="" class="btn btn-danger">delete</a>
		</td>
	</tr>
	<?php
	}
	?>
</table>

<?php

require_once("../includes/footer.php");

?>