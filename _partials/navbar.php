<?php
function getActiveClass($page, $expected) {
    if ($page == $expected)
        return('class="ui-btn-active ui-state-persist"');
    else   
        return('');
}

function createNavBar($page) {
?>
<div class="navbar" data-role="navbar" data-iconpos="top">
    <ul>
        <li>
            <a href="index.php" <?php echo(getActiveClass($page, 'index')); ?> rel="external" data-theme="a" data-transition="fade" data-theme="" data-icon="">
                <h3>Departments</h3>
            </a>
        </li>

        <li>
            <a href="doctor_list.php" <?php echo(getActiveClass($page, 'doctor_list')); ?> rel="external" data-theme="a" data-transition="fade" data-theme="" data-icon="">
                <h3>Doctors</h3>
            </a>
        </li>
        <li>
            <a href="#" data-transition="fade" data-theme="a" data-theme="" data-icon="">
                <h3>Sign Out</h3>
            </a>
        </li>
    </ul>
</div>
<?php
}
?>

