<?php
$db=mysql_connect("127.9.214.1:3306", "admin", "K45Ku7PA1Mp-")
  or die('I cannot connect to the database because: ' . mysql_error());
mysql_select_db("onshift", $db);
$id = $_GET['id'];
$query = "SELECT * FROM `Doctors` WHERE DoctorID = '".$id."'";

$result=mysql_query($query);
$row = mysql_fetch_array($result);

if($row['Picture']==null)
{
	header( 'Location: img/avatar.png' );
}

header("Content-type: image/png");

echo $row['Picture'];
?>