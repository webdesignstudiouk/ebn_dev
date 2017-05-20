<?php
$type="admin";
$title="All Agents";
require_once("../models/config.php");
require_once("../includes/header.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Forms posted
if(!empty($_POST)){

//Delete selected permission level
if(!empty($_POST['delete'])){
$deletions = $_POST['delete'];
if ($deletion_count = deletePermission($deletions)){
$successes[] = lang("PERMISSION_DELETIONS_SUCCESSFUL", array($deletion_count));
}
else {
$errors[] = lang("SQL_ERROR");	
}
}
else
{
//Update permission level name
if($permissionDetails['name'] != $_POST['name']) {
$permission = trim($_POST['name']);

//Validate new name
if (permissionNameExists($permission)){
$errors[] = lang("ACCOUNT_PERMISSIONNAME_IN_USE", array($permission));
}
elseif (minMaxRange(1, 50, $permission)){
$errors[] = lang("ACCOUNT_PERMISSION_CHAR_LIMIT", array(1, 50));	
}
else {
if (updatePermissionName($permissionId, $permission)){
$successes[] = lang("PERMISSION_NAME_UPDATE", array($permission));
}
else {
$errors[] = lang("SQL_ERROR");
}
}
}

//Remove access to pages
if(!empty($_POST['removePermission'])){
$remove = $_POST['removePermission'];
if ($deletion_count = removePermission($permissionId, $remove)) {
$successes[] = lang("PERMISSION_REMOVE_USERS", array($deletion_count));
}
else {
$errors[] = lang("SQL_ERROR");
}
}

//Add access to pages
if(!empty($_POST['addPermission'])){
$add = $_POST['addPermission'];
if ($addition_count = addPermission($permissionId, $add)) {
$successes[] = lang("PERMISSION_ADD_USERS", array($addition_count));
}
else {
$errors[] = lang("SQL_ERROR");
}
}

//Remove access to pages
if(!empty($_POST['removePage'])){
$remove = $_POST['removePage'];
if ($deletion_count = removePage($remove, $permissionId)) {
$successes[] = lang("PERMISSION_REMOVE_PAGES", array($deletion_count));
}
else {
$errors[] = lang("SQL_ERROR");
}
}

//Add access to pages
if(!empty($_POST['addPage'])){
$add = $_POST['addPage'];
if ($addition_count = addPage($add, $permissionId)) {
$successes[] = lang("PERMISSION_ADD_PAGES", array($addition_count));
}
else {
$errors[] = lang("SQL_ERROR");
}
}
}
}

$permissionId = "6";
$permissionDetails = fetchPermissionDetails($permissionId); //Fetch information specific to permission level
$permissionUsers = fetchPermissionUsers($permissionId); //Retrieve list of users with membership
$userData = fetchAllUsers(); //Fetch all users

echo $navbar_admin;
echo $before_body;
echo resultBlock($errors,$successes);
echo"
<form name='adminUsers' action='".$_SERVER['PHP_SELF']."' method='post'>
<table class='table table-condensed'>
<thead>
<tr>
<th>Id</th>
<th>Agent Name</th>
<th>View Agents Clients</th>
<th>View Sub Agents</th>
</tr>
</thead>
";

foreach ($userData as $v1) {
if(isset($permissionUsers[$v1['id']])){
echo "
<tr>
<td><a href='admin_user.php?id=".$v1['id']."'>".$v1['id']."</a></td>
<td>".$v1['first_name']."</td>
<td><a href='http://www.energybuyersnetwork.com/admin_agent.php?id=".$v1['id']."'>View</a></td>
<td><a href='http://www.energybuyersnetwork.com/admin_agent.php?id=".$v1['id']."'>View</a></td>
</tr>" ;
}
}

echo "    
</table>
</body>
</html>";
echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>
