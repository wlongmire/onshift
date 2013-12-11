<!-- page end div -->
</div>

<!--scripts -->

<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>


<script type="text/javascript" src="http://cloud.github.com/downloads/wycats/handlebars.js/handlebars-1.0.rc.1.min.js"></script>
<script type="text/javascript" src="js/code.js"></script></body>

<?php
function initPageJSObj($page) {
	switch($page) {
		case('index'):
			return('index_page.init({data:department_data});');
			break;
		case('doctor_list'):
			return('doctor_list_page.init({data:department_data});');
			break;	
		case('doctor_profile'):
			return('doctor_profile_page.init({data:department_data, index:' . $_GET['index'] . '});');
			break;
	}	
}

function createPageUI($page) {	
?>

<script type="text/javascript">
	<?php echo(initPageJSObj($page));?>
</script>

</html>	
<?php
}
?>
