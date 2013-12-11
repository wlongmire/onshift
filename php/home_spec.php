<?
	session_start();
	if($_SESSION['validated']==false)
		header( 'Location: sign-in.php' );
    
    $db=mysql_connect("127.9.214.1:3306", "admin", "K45Ku7PA1Mp-")
        or die('I cannot connect to the database because: ' . mysql_error());
    mysql_select_db("onshift", $db);

//First, we run a query on the database to get the list of specialities.
//We populate an array that we use to build the form later.
//In order to build the form, we put all of the important attributes in a string,
//seperated by the '#' character. This allows us to "explode" the string later
//and pick out each important part seperately.

    $result = mysql_query("SELECT * FROM Specialities");
    $numRows = mysql_num_rows($result);
    $rows = array($numRows);
    $doctorChildren = array($numRows);
    $ind = -1;
    
 while($row = mysql_fetch_array($result))
  {
     $ind = $ind + 1;
     $rows[$ind] = $row['Speciality'];
     $doctorChildren[$ind] = array();
  }

//In order to get the doctors, we populate an array of arrays that contains the doctors.

 $doctors = mysql_query("SELECT * FROM Doctors WHERE CURTIME() > ShiftBegin AND CURTIME() < ShiftEnd ORDER BY DoctorName");
 while ($row = mysql_fetch_array($doctors)) {
     for ($i = 0; $i < $numRows; $i++) {
        if ($row['Speciality'] == $rows[$i]) {
          $doctorChildren[$i][] = $row['DoctorID'] . "#" . $row['DoctorName'] . "#" . $row['ShiftBegin'] . "#" . $row['ShiftEnd'];
        }
     }
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
  <script>
  //This code mainly lets us show/hide the doctors.
      initContainers = false;
      len = 0;
      docContainers = null;
      function showDocs(index) {
          if (!initContainers) {
            docContainers = document.getElementsByClassName("doctContainer");
            while (docContainers.item(len) != null) {
               len = len + 1;
            }
            initContainers = true;
          }
          var docContainer = document.getElementById("doct" + index);
          for (i = 0; i < len; i ++) {
              docContainers.item(i).setAttribute("class", "doctContainer hide");
          }
          docContainer.setAttribute("class", "doctContainer show");
      }
  </script>
  </head>

  <body>

    <div id="wrap">
      <div id="main">
        <div class="container-narrow">
                
        <img src="img/logo.png" align="center" class="center" />
        <div class="jumbowrap">
          <div class="jumbotron">
            <?
                //Here, we iterate through the specialities, and then the doctors within each one.
                //We make the buttons and assign them the correct attributes, hiding the doctors after construction.
                $splitString = array(4);
                for ($i=0; $i < $numRows; $i++) {
                    $idstring = 'spec' . $i;
                    $doctstring = 'doct' . $i;
                    echo "<a class='btn btn-large btn-primary jumboBtn' onclick='showDocs(".$i.");' id=" . $idstring . ">" . $rows[$i] . "</a>";
                    echo "<div class='doctContainer hide' id=" . $doctstring . ">";
                    if (count($doctorChildren[$i]) == 0) {
                        echo "<a class='btn btn-inverse specBtnInv specBtn'>There is no specialist available at this time.</a>";
                    } else {
                        for ($j = 0; $j < count($doctorChildren[$i]); $j++) {
                            $splitString = explode("#", $doctorChildren[$i][$j]);
                            $doctorURL = "'/doctor.php?id=" . $splitString[0] . "'"; //preformatting the urls, times
                            $start = date("G:i", strtotime($splitString[2])); //in order to construct it easier.
                            $end = date("G:i", strtotime($splitString[3]));
                            echo "<a class='btn btn-info specBtn' href=" . $doctorURL . ">" . $splitString[1] . "<br/>" . $start . " - " . $end . "</a>";
                        }
                    }
                    echo "</div>";
                    
                }
            ?>
          </div>
         </div>
          <hr>
        </div>          
     </div>
     
      <div class="row-fluid center homeFooter">
        <div class="left">
          <a class="btn btn-large btn-info disabled" href="/home_spec.php">Specialities</a>
        </div>
    
        <div class="right">
          <a class="btn btn-large btn-primary" href="/home_doct.php">Doctors</a>
        </div>
      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

  </body>
</html>
