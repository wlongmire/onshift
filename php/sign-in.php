<?
session_start();
$_SESSION['validated']=false;
$_SESSION['user']="";
$_SESSION['email']="";

$db=mysql_connect("127.9.214.1:3306", "admin", "K45Ku7PA1Mp-")
  or die('I cannot connect to the database because: ' . mysql_error());
mysql_select_db("onshift", $db);

	$user = $_POST["username"];
	$pass= $_POST["password"];
	$error=false;
	
	$result = mysql_query("SELECT * FROM Users WHERE username='".$user."' AND password='".$pass."'");
	$row = mysql_fetch_array($result);

	if(!$result || mysql_num_rows($result) <= 0)
	{
		if($user !="" && $pass !="")
			$error=true;
	}
	else
	{
		//set a session variable
		$_SESSION['validated']=true;
		$_SESSION['user']=$user;
		$_SESSION['email']=$row['Email'];
		//redirect to home
		header( 'Location: home_spec.php' );
	}

mysql_close($db);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
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
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
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

      <form class="form-signin" action='sign-in.php' method='post' accept-charset='UTF-8'>
        <h2 class="form-signin-heading">Please sign in</h2>
		<? if($error) 
			echo "ERROR!"; ?>
        <input type="text" name='username' id='username'  class="input-block-level" value ="<?echo $user?>" placeholder="Username" />
        <input type='password' name='password' id='password' class="input-block-level" placeholder="Password" />
        <button class="btn btn-large btn-primary" type="submit" name='Submit' value='Submit'>Sign in</button>
      </form>

    </div> <!-- /container -->

</html>