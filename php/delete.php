<?
$photo=$_GET["photo"];
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $photo);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

// grab URL and pass it to the browser
curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);
echo "<br>File Deleted!";
?>