<?php
include '_partials/header.php';
setHeader("doctor_profile");

include '_partials/navbar.php';
createNavBar('doctor_list');
?>

<div id="doctor_container"></div>

 <div id="com_nav" data-role="navbar" data-iconpos="top">
    <ul>
        <li>
            <a id="page_button" href="#"data-transition="fade" data-theme="b" data-icon="">
                <h3>Page</h3>
            </a>
        </li>
        <li>
            <a id="call_button"  href="#" data-transition="fade" data-theme="b" data-icon="">
                <h3>Call</h3>
            </a>
        </li>
        <li>
            <a id="text_button" href="#" data-transition="fade" data-theme="b" data-icon="">
                <h3>Text</h3>
            </a>
        </li>
    </ul>
</div>

<div id="text_area" style="width:100%; text-align:center; background-color:#6D88B3" id="texting_box">
        <textarea rows="4" cols="50"></textarea>
        <button style="display:inline; width:20px" id="textbutton">Send</button>
        <button style="display:inline; width:20px"  id="textbutton">Attach</button>
</div>

<?php 
include '_partials/footer.php';
createPageUI("doctor_profile");
?>