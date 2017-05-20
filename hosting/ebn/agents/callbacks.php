<?php
$type = "user";
require_once("../models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$userId = $_GET['id'];
$userdetails = fetchUserDetails(NULL, NULL, $userId);
$agentsname = $userdetails['user_name'];
$company = $userdetails['company'];
$agentfname = $loggedInUser->firstname;
$agentsname = $loggedInUser->secondname;
$title = "${agentfname} ${agentsname} > Dashboard > Prospect Details > ${company} > Callbacks";

require_once("../includes/header.php");
navbaruser($userId, "Call Backs");
 echo $before_body;
echo resultBlock($errors,$successes);

echo"<div id='tbb_f' class='tab-pane'>
<h1 class='heading_a'>User's Callbacks</h1>
<a href='create_callback.php?id=$userId' class='btn btn-primary' style='float:right; margin-right:30px; margin-top:20px;'class='button white' >Create Callback</a>

<form name='insertNotes' action='delete_callback.php' method='post'>	
<table class='table table-striped'>

<thead>
<tr>
<th>Delete</th>
<th>Full Name</th>
<th>Company</th>
<th>Phone Number</th>
<th>Callback Date</th>
<th>Description</th>
</tr>
</thead>";

$conn = mysql_connect($db_host, $db_user, $db_pass);
if(! $conn ) { die('Could not connect: ' . mysql_error()); }
mysql_select_db('ebndb');
$retval = mysql_query( "SELECT id, description, date FROM uc_callbacks WHERE user_id = '" . $userId . "'", $conn );
if(! $retval ) { die('Could not get data: ' . mysql_error()); }
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
echo"<tr>
<td><input type='radio' name='callbackId' value='{$row['id']}'><input type='hidden' name='userId' value='${userId}'></td>
<td>" ,$userdetails['first_name'], " ", $userdetails['second_name'], "</td>
<td>", $userdetails['company'],"</td>
<td>", $userdetails['phonenumber'],"</td>
<td>{$row['date']}</td>
<td>{$row['description']}</td>
</tr>";
} 
mysql_close($conn);

echo"
</tbody>
</table>
<input type='submit' class='btn btn-primary' style='float:right; margin-right:30px; margin-top:20px;' value='Delete Callback' class='button white' />
</div>
</form>";

echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>