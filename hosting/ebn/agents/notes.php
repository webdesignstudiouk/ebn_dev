<?php
$type = "user";
$title = "Notes";
require_once("../models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$userId = $_GET['id'];
$userdetails = fetchUserDetails(NULL, NULL, $userId);
$agentsname = $userdetails['user_name'];
$company = $userdetails['company'];
$agentfname = $loggedInUser->firstname;
$agentsname = $loggedInUser->secondname;
$title = "${agentfname} ${agentsname} > Dashboard > Prospect Details > ${company} > Notes";

require_once("../includes/header.php");
navbaruser($userId, "Notes");
echo $before_body;
echo resultBlock($errors,$successes);

echo"<div id='tbb_f' class='tab-pane'>
<h1 class='heading_a'>User's Notes</h1>
<a href='create_note.php?id=$userId' class='btn btn-primary' style='float:right; margin-right:30px; margin-top:20px;'class='button white' >Create Note</a>

<form name='insertNotes' action='delete_note.php' method='post'>	
<table class='table table-striped'>

<thead>
<tr>
<th>Delete</th>
<th>Timestamp</th>
<th>Note</th>
</tr>
</thead>";

$conn = mysql_connect($db_host, $db_user, $db_pass);
if(! $conn ) { die('Could not connect: ' . mysql_error()); }
mysql_select_db('ebndb');
$retval = mysql_query( "SELECT id, description, timestamp FROM uc_notes WHERE user_id = '" . $userId . "'", $conn );
if(! $retval ) { die('Could not get data: ' . mysql_error()); }
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
echo"<tr>
<td><input type='radio' name='noteId' value='{$row['id']}'><input type='hidden' name='userId' value='${userId}'></td>
<td>{$row['timestamp']}</td>
<td>{$row['description']}</td>
</tr>";
} 
mysql_close($conn);

echo"
</tbody>
</table>
<input type='submit' class='btn btn-primary' style='float:right; margin-right:30px; margin-top:20px;' value='Delete Note' class='button white' />
</div>

</form>
</body>
</html>";

echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>