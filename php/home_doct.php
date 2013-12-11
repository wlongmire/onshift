<?
	session_start();
	if($_SESSION['validated']==false)
		header( 'Location: sign-in.php' );
    
    $db=mysql_connect("127.9.214.1:3306", "admin", "K45Ku7PA1Mp-")
        or die('I cannot connect to the database because: ' . mysql_error());
    mysql_select_db("onshift", $db);

//First, we run a query on the database to get the list of doctors.
//We populate an array that we use to build the form later.
//In order to build the form, we put all of the important attributes in a string,
//seperated by the '#' character. This allows us to "explode" the string later
//and pick out each important part seperately.
     $doctors = mysql_query("SELECT * FROM Doctors WHERE CURTIME() > ShiftBegin AND CURTIME() < ShiftEnd ORDER BY DoctorName");
     $numRows = mysql_num_rows($doctors);
     $doctorChildren = array($numRows);
     //echo "numRows " . $numRows . "</br>";
     $ind = -1;
     while ($row = mysql_fetch_array($doctors)) {
       $ind = $ind + 1;
       $doctorChildren[$ind] = $row['DoctorID'] . "#" . $row['DoctorName'] . "#" . $row['ShiftBegin'] . "#" . $row['ShiftEnd'] . "#" . $row['Speciality'];
       //echo $doctorChildren[$ind] . "<br/>";
    }

mysql_close($db);
    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>OnShift &middot; Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/styles.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 40px;
      }

      /* Custom container */
      .container-narrow {
        min-width: 340px;
        margin: 0 auto;
        max-width: 700px;
      }
      .container-narrow > hr {
        margin: 30px 0;
      }


      /* sticky foot 
      html, body {height: 100%;}
      #wrap {min-height: 100%}
      #main {
          overflow:auto;
          padding-bottom: 50px;}
          
      #footer {
          position: relative;
          margin-top: -50px;
          height: 150px;
          clear:both;
      } */

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

    <div id="wrap">
      <div id="main">
        <div class="container-narrow">
                
        <img src="img/logo.png" align="center" class="center" />
        <div class="jumbowrap">
          <div class="jumbotron">
            <?
                $splitString = array(5);
                for ($i=0; $i < $numRows; $i++) {
                    $splitString = explode("#", $doctorChildren[$i]);
                    $start = date("G:i", strtotime($splitString[2]));
                    $end = date("G:i", strtotime($splitString[3]));
                    $doctstring = 'doct' . $splitString[0];
                    $doctorURL = "'/doctor.php?id=" . $splitString[0] . "'";
                    echo "<a class='btn btn-primary specBtn' href=" . $doctorURL . ">" . $splitString[1] . "<div class='specBtnInv'>" . $splitString[4] . "<br/>" . $start . " - " . $end . "</div></a>";                    
                }
            ?>
          </div>
         </div>
          <hr>
        </div>          
     </div>
     
      <div class="row-fluid center homeFooter">
        <div class="left">
          <a class="btn btn-large btn-primary" href="/home_spec.php">Specialities</a>
        </div>
    
        <div class="right">
          <a class="btn btn-large btn-info disabled" href="/home_doct.php">Doctors</a>
        </div>
      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

  </body>
</html>
