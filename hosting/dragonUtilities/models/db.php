<?php
 
//Database Information
$db_host = "160.153.16.28"; //Host address (most likely localhost)  
$db_name = "ACPMoney"; //Name of Database
$db_user = "michaeltaylor"; //Name of database user
$db_pass = "Michaelb1!"; //Password for database user

GLOBAL $errors;
GLOBAL $successes;

$errors = array(); 
$successes = array();

/* Create a new mysqli object with database connection parameters */
$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
$stmt = $mysqli->prepare("SET time_zone = 'Europe/London'");  
$stmt->execute(); 
$stmt->close();   

GLOBAL $mysqli;
 
if(mysqli_connect_errno()) {
	echo "Connection Failed: " . mysqli_connect_errno();
	exit();
}


?>