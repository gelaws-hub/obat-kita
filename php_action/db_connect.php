<?php 	

$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "obat-kita";
$store_url = "http://localhost/dawapharma/";
// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>