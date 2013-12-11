<?php
include '_partials/header.php';
setHeader("doctor_list");

include '_partials/navbar.php';
createNavBar('doctor_list');
?>


<div id="doctor_container" data-role="content"></div>

<?php 
include '_partials/footer.php';
createPageUI("doctor_list");
?>