<?php

///////////////////////////////////////////callbacks

//retrieve all callbacks
function fetchCallbacks() {
global $mysqli,$db_table_prefix; 
$stmt = $mysqli->prepare("SELECT id, name, email, phonenumber, status, agentId FROM callbacks");	
$stmt->execute();
$stmt->bind_result($id, $name, $email, $phonenumber, $status, $agentId);
while ($stmt->fetch()){ 
$row[] = array('id' => $id, 'name' => $name, 'email' => $email, 'phonenumber' => $phonenumber, 'status' => $status, 'agentId' => 			$agentId);
} 
$stmt->close();
return ($row);
}

//add a callback to the DB
function addCallback($name, $email, $phonenumber, $status, $agentId) {
global $mysqli,$db_table_prefix; 
$stmt = $mysqli->prepare("INSERT INTO callbacks 
(name, email, phonenumber, status, agentId) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phonenumber, $status, $agentId);
$result = $stmt->execute();
return $stmt->insert_id;
$stmt->close();	
}

//count callbacks
function countCallbacks(){
global $mysqli,$db_table_prefix;
$stmt = $mysqli->prepare("SELECT id FROM callbacks");
$stmt->execute();
$stmt->store_result();
$result = $stmt->num_rows;
$stmt->close();
return $result; 
}

///////////////////////////////////////////users

//retrieve all users
function fetchUsers() {
global $mysqli,$db_table_prefix; 
$stmt = $mysqli->prepare("SELECT id, username, first_name, last_name FROM users");	
$stmt->execute();
$stmt->bind_result($id, $username, $first_name, $last_name);
while ($stmt->fetch()){ 
$row[] = array('id' => $id, 'username' => $username, 'first_name' => $first_name, 'last_name' => $last_name);
} 
$stmt->close();
return ($row);
}

//count users
function countUsers(){
global $mysqli,$db_table_prefix;
$stmt = $mysqli->prepare("SELECT id FROM users");
$stmt->execute();
$stmt->store_result();
$result = $stmt->num_rows;
$stmt->close();
return $result; 
}


?>