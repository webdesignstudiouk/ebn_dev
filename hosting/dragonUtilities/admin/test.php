<?php
require_once("../models/config.php");

$callbacks = fetchCallbacks();
$countCallbacks = countCallbacks();
echo "COUNT: ".$countCallbacks."<br/><br/>";

foreach ($callbacks as $c1){
echo "ID: ".$c1['id']."<br/>";	
echo "NAME: ".$c1['name']."<br/>";		
echo "EMAIL: ".$c1['email']."<br/>";	
echo "PHONENUMBER: ".$c1['phonenumber']."<br/>";
echo "STATUS: ".$c1['status']."<br/>";
echo "AGENTID: ".$c1['agentId']."<br/>";
echo "<br/>";
}



?>
