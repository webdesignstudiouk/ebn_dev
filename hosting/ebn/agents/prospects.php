<?php
$type="agent";
require_once("../models/config.php");
$agentfname = $loggedInUser->firstname;
$agentsname = $loggedInUser->secondname;
$title = "${agentfname} ${agentsname} > Dashboard > All Prospects";

if (!securePage($_SERVER['PHP_SELF'])){die();}
$userData = fetchAllUsers(); //Fetch information for all users
require_once("../includes/header.php");

echo $navbar_agents;
echo $before_body;
echo resultBlock($errors,$successes);

echo "<form name='adminUsers' action='".$_SERVER['PHP_SELF']."' method='post'>

<a href='create_prospects.php' class='btn btn-primary' style='float:right;'>Create Prospect</a>

<table class='table table-condensed'>
<thead>
<tr>
<th>Prospect ID</th>
<th>Company</th>
<th>Contact</th>
<th>User Type</th>
</tr>
</thead>";

foreach ($userData as $v1) {
if ($v1['agent_id_sub'] == $loggedInUser->user_id){
echo "
<tr>
<td>".$v1['id']."</td>
<td>".$v1['company']."</td>
<td>".$v1['first_name']." ".$v1['second_name']."</td>
<td style='background-color:#fff;'><a href='../agents/user.php?id=".$v1['id']."' >View Account</a></td>
</tr>";
}
}

echo "
</tbody>
</table>
</html>";
echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>

