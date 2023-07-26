<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "news-site";

$con = mysqli_connect($servername,$username,$password,$dbname);
if(!$con){
	die("Couldn't connect".mysqli_connect_error());
}
?>