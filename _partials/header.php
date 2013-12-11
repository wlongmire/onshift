<!DOCTYPE html> 

<html> 

<head> 
    <meta charset="utf-8" />

    <title>OnShift</title> 
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />

    <link href='http://fonts.googleapis.com/css?family=Text+Me+One' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/style.css">
</head> 

<body>

<!-- logo-->
<?php
function setHeader($page) {
?>
<div data-role="page" id="<?php echo($page); ?>">
<div data-theme="a" data-role="header">
    <h3><span id='logo'></span><span id="title">OnShift<span></h3>
</div>

<?php
}
?>

