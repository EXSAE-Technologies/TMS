<?php

require_once("../includes/header.php");

$subjects = new Subjects();
$subjectsObjects = $subjects->get_all_subjects();

$components = new Components($root);
echo $components->admin_navbar(); 

if (isset($_POST["type"])) {
	if ($_POST["type"] == "add-subject"){
		$subjects->add_subject($_POST["name"], $_POST["level"]);
		header("Location: ".$root."admin/subjects.php");
	}
}

if (isset($_GET["type"])) {
	if ($_GET["type"] == "delete") {
		$subjects->delete_subject($_GET["id"]);
		header("Location: ".$root."admin/subjects.php");
	}
}
?>

<div class="container-sm">
	<form method="post">
		<input type="hidden" name="type" value="add-subject">
		<div class="form-group">
			<div class="input-group">
				<input class="form-control" type="text" name="name" placeholder="Enter Name">
				<span class="input-group-addon"></span>
			</div>
		</div>
		<div class="form-group">
			<div class="input-group">
				<select name="level" class="form-control">
					<option value="2">Senior</option>
					<option value="3">Junior</option>
				</select>
				<span class="input-group-addon"></span>
			</div>
		</div>
		<button class="btn btn-primary" type="submit">Add Subject</button>
	</form>
	<table class="table">
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Level</th>
			<th></th>
		</tr>
		<?php
		foreach($subjectsObjects as $subject){
		?>
		<tr>
			<td><?php echo $subject[0]; ?></td>
			<td><?php echo $subject[1]; ?></td>
			<td><?php echo $subject[2]; ?></td>
			<td>
				<a href="?type=edit&id=<?php echo $subject[0]; ?>" class="btn btn-primary">edit</a>
				<a href="?type=delete&id=<?php echo $subject[0]; ?>" class="btn btn-danger">delete</a>
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