<?php
$type = "agent";
$title = "My Callbacks";
require_once("../models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("../includes/header.php");
echo $navbar_agents;
echo $before_body;
echo resultBlock($errors,$successes);

echo"<div class='col-sm-12'>
<div class='panel panel-default'>
<div class='panel-heading'>
<h4 class='panel-title'>Callbacks Today</h4>
</div>
<div class='panel-body'>
<div class='sepH_c'>

<table class='table'>
<thead>
<tr>
<th>Full Name</th>
<th>Company</th>
<th>Description</th>
<th>View User Profile</th>
<th>View User Callbacks</th>
</tr>
</thead>
<tbody>";

$callbacks = fetchcallbacks();
foreach ($callbacks  as $v1) {
$users_hd = fetchUserDetails(NULL, NULL, $v1['user_id']);
if ($today == $v1['date']){

if ($users_hd['agent_id_sub'] == $loggedInUser->user_id ) {
echo"<tr>
<td><a href='user.php?id=", $users_hd['id'] ,"'> ", $users_hd['first_name'], " ", $users_hd['second_name'], "</a></td>
<td>", $v1['description'], "</td>
<td><a href='user.php?id=", $users_hd['id'] ,"'>View Profile</a></td>
<td><a href='callbacks.php?id=", $users_hd['id'] ,"'>View Callbacks</a></td>
</tr>";
}
}else{echo "";}

}
echo"</tbody></table></div></div></div></div>";


echo"<div class='col-sm-12'>
<div class='panel panel-default'>
<div class='panel-heading'>
<h4 class='panel-title'>Future Callbacks</h4>
</div>
<div class='panel-body'>
<div class='sepH_c'>

<table class='table'>
<thead>
<tr>
<th>Client Name</th>
<th>Description</th>
<th>View User Profile</th>
<th>View User Callbacks</th>
</tr>
</thead>
<tbody>";

$callbacks = fetchcallbacks();
foreach ($callbacks  as $v1) {
$users_hd = fetchUserDetails(NULL, NULL, $v1['user_id']);


if ($users_hd['agent_id_sub'] == $loggedInUser->user_id ) {
echo"<tr>
<td><a href='user.php?id=", $users_hd['id'] ,"'> ", $users_hd['first_name'], " ", $users_hd['second_name'], "</a></td>
<td>", $v1['description'], "</td>
<td><a href='user.php?id=", $users_hd['id'] ,"'>View Profile</a></td>
<td><a href='callbacks.php?id=", $users_hd['id'] ,"'>View Callbacks</a></td>
</tr>";
}

}
echo"</tbody></table></div></div></div></div>";

echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?> 