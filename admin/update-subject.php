<?php

require_once("../includes/header.php");

if (isset($_GET["subject_id"])){

$subjects = new Subjects();
$subjectsObject = $subjects->get_subject_by_id($_GET["subject_id"]);

$components = new Components($root);
echo $components->admin_navbar(); 
?>



<?php
} else {
	header("Location: ".$root."admin/subjects.php");
}
require_once("../includes/footer.php");

?>