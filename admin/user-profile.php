<?php

require_once("../includes/header.php");

$components = new Components($root);
echo $components->admin_navbar();

$users = new Users();

if (isset($_POST["type"])) {
	if ($_POST["type"] == "change-account-level"){
		$users->update_user($_POST["id"], "", "", "", "", "",$_POST["tms_group_id"]);
		header("Location: ".$root."admin/user-profile.php?user_id=".$_POST["id"]);
	}
}

if (isset($_GET["user_id"])){
$userObject = $users->get_user_by_id($_GET["user_id"]);
?>

<div class="container-sm">
	
<center>
	<img src="<?php echo $root.$userObject["image_url"]; ?>" class="w-auto" height="200px;">
</center>

<div class="panel">
	<div class="panel-header">
		<h3>Details</h3>
	</div>
	<div class="panel-body">
		<table class="table">
			<tr>
				<th>Username</th>
				<td><?php echo $userObject["username"]; ?></td>
			</tr>
			<tr>
				<th>First Name</th>
				<td><?php echo $userObject["first_name"]; ?></td>
			</tr>
			<tr>
				<th>Last Name</th>
				<td><?php echo $userObject["last_name"]; ?></td>
			</tr>
			<tr>
				<th>Contact Number</th>
				<td><?php echo $userObject["contact_number"]; ?></td>
			</tr>
			<tr>
				<th>E-mail</th>
				<td><?php echo $userObject["email"]; ?></td>
			</tr>
			<tr>
				<th>Account Level</th>
				<td><?php echo $userObject["tms_group_id"]; ?></td>
			</tr>
		</table>
	</div>
</div>

<div class="row">
	<div class="col-sm">
		<form method="post">
			<input type="hidden" name="type" value="change-account-level">
			<input type="hidden" name="id" value="<?php echo $userObject["id"]; ?>">
			<div class="form-group">
				<div class="input-group">
					<select class="form-control" name="tms_group_id">
						<option value="1">Staff</option>
						<option value="2">Senior Student</option>
						<option value="3">Junior Student</option>
					</select>
					<span class="input-group-addon"><button type="submit" class="btn btn-primary">Change Account Level</button></span>
				</div>
			</div>
		</form>
	</div>
	<div class="col-sm">
		<form method="post">
			<input type="hidden" name="type" value="change-password">
			<div class="form-group">
				<div class="input-group">
					<input type="password" name="password" class="form-control">
					<span class="input-group-addon"><button type="submit" class="btn btn-primary">Change Password</button></span>
				</div>
			</div>
		</form>
	</div>
</div>

</div>

<?php

} else {
	header("Location: ".$root."admin/users.php");
}

require_once("../includes/footer.php");

?>