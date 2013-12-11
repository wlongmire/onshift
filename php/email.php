<?
session_start();
$user=$_SESSION['user'];
$email=$_SESSION['email'];

echo "<script type='text/javascript'>alert('" . $email . "'); </script>";

$photo = $_POST['photo'];
//define the receiver of the email
$to = $_POST['email'];
//define the subject of the email
$message = "<html><head></head><body>".$_POST['message'];
if($photo!="" && $photo != null)
{
	$photourl="'".$photo."'";
	$message=$message."\n"."<img src=".$photourl."></img>"."\n".$photo;
	$message=$message."\n\n"."<a href='https://onshift-pennapps13.rhcloud.com/delete.php?photo=".$photo."'><br><br>Delete File</a>";
}
$message=$message."</body></html>";

$subject = $user.' Sent You a Message on OnShift!'; 
//define the headers we want passed. Note that they are separated with \r\n
$headers = "Content-Type: text/html"."\r\n";
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
/*echo $mail_sent ? "Mail sent" : "Mail failed";
echo $to;
echo "<p>";
echo $message;*/

$id = $_POST['id'];
   header( 'Location: doctor.php?id='.$id ) ;
?>