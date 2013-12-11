<?php
include '_partials/header.php';
setHeader("index");

include '_partials/navbar.php';
createNavBar('index');

?>

	<div id="department_container" data-role="collapsible-set" >
	</div>

<?php 
include '_partials/footer.php';
createPageUI("index");
?>