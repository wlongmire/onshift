<?
	session_start();
	if($_SESSION['validated']==false)
		header( 'Location: sign-in.php' );

$db=mysql_connect("127.9.214.1:3306", "admin", "K45Ku7PA1Mp-")
  or die('I cannot connect to the database because: ' . mysql_error());
mysql_select_db("onshift", $db);

	$id = $_GET["id"];
	$error=false;
	
	$result = mysql_query("SELECT * FROM Doctors,Specialities WHERE DoctorID='".$id."' AND Doctors.Speciality = Specialities.Speciality");

	while($row = mysql_fetch_array($result))
	{
		$name=$row['DoctorName'];
		$spec=$row['Speciality'];
		$Spager=$row['SpecPagerNo'];
		$pager= $row['PagerNo'];
		$start= $row['ShiftBegin'];
		$end=$row['ShiftEnd'];
		$email=$row['Email'];
	}

mysql_close($db);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Doctor Summary</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
            <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<script type="text/javascript" src="//api.filepicker.io/v1/filepicker.js"></script>
	<script type="text/javascript">
	filepicker.setKey("AzauR2MBSBeslVoQIcZ8gz");
	$(function(){
	$("#attach-file").change(function(){
		document.getElementById('send').disabled = true; 
		document.getElementById('result').style.display="none";
		document.getElementById('uploading').style.display="block";
		filepicker.store(this, function(FPFile){
			$("#attach-photo").val(FPFile.url);
			document.getElementById('send').disabled = false; 
			document.getElementById('result').style.display="block";
			document.getElementById('uploading').style.display="none";
		});
	});
	});
</script>
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .info {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .info .info-heading,
      .info .checkbox {
        margin-bottom: 10px;
      }
      .info input[type="text"],
      .info input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
	  h2 {
		font-size: 25px;
	 }
	 textarea {
		resize: none;
	}
	#upload-file-container {
   background: url(img/attach.png) no-repeat;
   width:50px;
   height:50px;
   float:left;
}

#upload-file-container input {
   opacity: 0;
   filter: alpha(opacity = 50);
}

    </style>
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="bootstrap/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="bootstrap/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="bootstrap/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="bootstrap/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="bootstrap/ico/favicon.png">
  </head>

  <body>

    <div class="container">

      <div class="info" >
        <h2 class="info-heading"><?echo $name?></h2>
		<p>Speciality: <?echo $spec?></p>
		<img src ="img.php?id=<?echo $id?>" />
		<p><a style="float:left; margin-left:10px;" href="tel:<?echo $Spager?>"><img src="img/spec_phone.png" /></a>
		<a style="float:right; margin-right:10px;" href="tel:<?echo $pager?>"><img src="img/pers_phone.png" /></a></p>
		<p></p>
		<form action="email.php" method="post">
		<input type="hidden" name="email" value="<?echo $email;?>" /> 
		<input type="hidden" name="id" value="<?echo $id;?>" /> 
		<textarea name="message" style="margin-top:10px; width:250px;" rows="5" cols="30" placeholder="Enter a message to send"></textarea>
		<p>Hours: <?echo date("G:i", strtotime($start));?> - <?echo date("G:i", strtotime($end));?></p>
		<!--<a style="margin-left:10px;" id="attach"><img src="img/attach.png" alt="Attach" /></a>-->
		<div id="upload-file-container">
		<input type="file" id="attach-file" style="float:left; width:150px; height:50px;"/>
		<div id="result" style="float: left; margin-left:50px; width:100px; margin-top:-30px; display:none">File Uploaded!</div>
		<div id="uploading" style="float: left; margin-left:50px; width:100px; margin-top:-30px; display:none">Uploading...</div>
		<input type="hidden" name="photo" id="attach-photo"/>
		</div>
		
		<button  id="send" style="float:right; padding:15px; font-size:40px;" type="submit" value="Submit" class="btn btn-primary">Send</button>
		<br>
		</form>
		
      </div>

    </div> <!-- /container -->

  </body>
</html>