<?php
$type="agent";
$title="My Clients"; 
require_once("../models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$userData = fetchAllUsers(); //Fetch information for all users
require_once("../includes/header.php");

echo $navbar_agents;
echo $before_body;
echo resultBlock($errors,$successes);

echo "<form name='adminUsers' action='".$_SERVER['PHP_SELF']."' method='post'>
<table class='table table-condensed'>
<thead>
<tr>
<th>id</th>
<th>Name</th>
<th>Email</th>
<th>User Type</th>
<th>View Account</th>
</tr>
</thead>";

foreach ($userData as $v1) {
if ($v1['agent'] == $loggedInUser->user_id){
echo "
<tr style='", alluserscolour($v1['id']), "'>
<td>".$v1['id']."</td>
<td>".$v1['first_name']."</td>
<td>".$v1['email']."</td>
<td>", alluserstype($v1['id']), "</td>
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

