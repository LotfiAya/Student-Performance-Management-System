<?php  


$sName = "localhost";
$uName = "root";
$pass  = "";
$db_name = "sms_db";

// La connection à la bd tout en gérant les exception when they can occur lors de la cnx 	
try {
	$conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOExeption $e){
	echo "Connection failed: ". $e->getMessage();
	exit;
}