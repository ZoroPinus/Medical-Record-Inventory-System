<?php  

$host ="";
$user ="root";
$pass="";
$db ="uccs_db";
$conn = mysqli_connect($host,$user,$pass,$db);
mysqli_set_charset($conn,"utf8");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 



?>
