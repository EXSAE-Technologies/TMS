<?php

require_once("../includes/header.php");

$components = new Components($root);

echo $components->admin_navbar();
?>

<div class="container-sm">
	<?php echo $components->table(["name", "age"], [["Funduluka", "20"]]); ?>
</div>

<?php

require_once("../includes/footer.php");

?>