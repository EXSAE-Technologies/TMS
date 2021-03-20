<?php

require_once("../includes/header.php");

$components = new Components($root);
echo $components->admin_navbar();

if (isset($_GET["user_id"])){

$users = new Users();
$userObject = $users->get_user_by_id($_GET["user_id"]);

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
	if ($_POST["type"] == "update-user"){
		$users->update_user($_POST["id"], $_POST["username"], $_POST["first_name"], $_POST["last_name"], $_POST["contact_number"], $_POST["email"]);
		header("Location: ".$root."admin/update-user.php?user_id=".$_POST["id"]);
	}
}
?>

<div class="container-sm">
	
	<h1><?php echo $userObject["username"]; ?></h1>

	<?php
	echo $users->edit_user_form($_GET["user_id"]);
	?>

</div>

<?php

} else {
	header("Location: ".$root."admin/users.php");
}
require_once("../includes/footer.php");

?>