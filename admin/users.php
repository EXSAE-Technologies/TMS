<?php

require_once("../includes/header.php");


$components = new Components($root);
echo $components->admin_navbar();

$users = new Users();
$userObjects = $users->get_all_users();

if (isset($_GET["type"])){
	if ($_GET["type"] == "activation"){
		$users->update_user($_GET["id"], "", "", "", "", "", "", "", "ACTIVATED");
		header("Location: ".$root."admin/users.php");
	} elseif ($_GET["type"] == "deactivation") {
		$users->update_user($_GET["id"], "", "", "", "", "", "", "", "DEACTIVATED");
		header("Location: ".$root."admin/users.php");
	} elseif ($_GET["type"] == "delete"){
		$users->delete_user($_GET["id"]);
		header("Location: ".$root."admin/users.php");
	}
}

if (isset($_POST["type"])){
	if ($_POST["type"] == "add-user"){
		$users->add_user($_POST["username"], $_POST["first_name"], $_POST["last_name"], $_POST["contact_number"]);
		header("Location: ".$root."admin/users.php");
	}
}
?>

<div class="container">
<?php
echo $users->add_user_form();
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
				<a href="?type=deactivation&id=<?php echo $userObject[0]; ?>" class="btn btn-warning">deactivate</a>
			<?php
			} else {
			?>
				<a href="?type=activation&id=<?php echo $userObject[0]; ?>" class="btn btn-success">activate</a>
			<?php
			}
			?>
			<a href="update-user.php?user_id=<?php echo $userObject[0]; ?>" class="btn btn-primary">edit</a>
			<a href="?type=delete&id=<?php echo $userObject[0]; ?>" class="btn btn-danger">delete</a>
		</td>
	</tr>
	<?php
	}
	?>
</table>

</div>

<?php

require_once("../includes/footer.php");

?>