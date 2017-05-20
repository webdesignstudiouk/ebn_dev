<?php
require_once("../models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

$id = ($_GET['id']);
$userId = $_GET['id'];
$userdetails = fetchUserDetails(NULL, NULL, $userId); //Fetch user details
$agentsname = $userdetails['user_name'];

$pagescript = <<<XYZ
<div id='main'>
<div class='top_shadow'></div>
<style type='text/css'>
    .bb td, .bb th {
     border-bottom: 1px solid #f7f7f7 !important;
	 padding-bottom:7px;
    }
  </style>


XYZ;
echo $pagescript;

$dbhost = 'ebndb.db.9825564.hostedresource.com';
$dbuser = 'ebndb';
$dbpass = 'Michaelt1!';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db('ebndb');
$retval = mysql_query( "SELECT user_name, first_name, 
               email, id, phonenumber FROM uc_users
        WHERE agent_id_sub = '" . $agentsname . "'", $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
    echo "
	<h1>$agentsname's Sub Agents</h1>
	<table  style='background-color:#FFF' width='100%'  >
	
	<tr class='bb'>
	<td><b>User Name</b></td>
	<td><b>Email</b></td>
	<td><b>View Acoount</b></td>
	<td><b>View Users Clients</b></td>
	</tr>
	
	<tr class='bb'>
	<td>{$row['user_name']}</td>
	<td>{$row['email']}</td>
	<td><a href='admin_user.php?id={$row['id']}'>View</a></td>
	<td><a href='admin_agent.php?id={$row['id']}'>View</a></td>
	</tr>
	</table>";
} 
mysql_close($conn);
 

$dbhost = 'ebndb.db.9825564.hostedresource.com';
$dbuser = 'ebndb';
$dbpass = 'Michaelt1!';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}

mysql_select_db('ebndb');
$retval = mysql_query( "SELECT user_name, first_name, 
               email, id, phonenumber FROM uc_users
        WHERE agent = '" . $agentsname . "'", $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
    echo "
	<h1>$agentsname's Clients</h1>
	<table  style='background-color:#FFF' width='100%'  >
	
	<tr class='bb'>
	<td><b>User Name</b></td>
	<td><b>Email</b></td>
	<td><b>View Acoount</b></td>
	</tr>
	
	<tr class='bb'>
	<td>{$row['user_name']}</td>
	<td>{$row['email']}</td>
	<td><a href='admin_user.php?id={$row['id']}'>View</a></td>
	</tr>
	</table>";
} 
mysql_close($conn);

?>