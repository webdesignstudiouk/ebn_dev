<?php
$type="admin";
$title="All Permissions";
require_once("../models/config.php");
require_once("../includes/header.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Forms posted
if(!empty($_POST))
{
//Delete permission levels
if(!empty($_POST['delete'])){
$deletions = $_POST['delete'];
if ($deletion_count = deletePermission($deletions)){
$successes[] = lang("PERMISSION_DELETIONS_SUCCESSFUL", array($deletion_count));
}
}

//Create new permission level
if(!empty($_POST['newPermission'])) {
$permission = trim($_POST['newPermission']);

//Validate request
if (permissionNameExists($permission)){
$errors[] = lang("PERMISSION_NAME_IN_USE", array($permission));
}
elseif (minMaxRange(1, 50, $permission)){
$errors[] = lang("PERMISSION_CHAR_LIMIT", array(1, 50));	
}
else{
if (createPermission($permission)) {
$successes[] = lang("PERMISSION_CREATION_SUCCESSFUL", array($permission));
}
else {
$errors[] = lang("SQL_ERROR");
}
}
}
}

$permissionData = fetchAllPermissions(); //Retrieve list of all permission levels

echo $navbar_admin;
echo $before_body;
echo resultBlock($errors,$successes);

echo "
<div class='user_content'>
<form name='updateAccount' class='form-horizontal user_form' action='".$_SERVER['PHP_SELF']."' method='post'>
<table class='table table-condensed'>
<thead>
<tr>
<th>Id</th>
<th>Delete</th>
<th>Permission Name</th>
</tr>
</thead>";

//List each permission level
foreach ($permissionData as $v1) {
echo "
<tr>
<td>".$v1['id']."</td>
<td><input type='checkbox' name='delete[".$v1['id']."]' id='delete[".$v1['id']."]' value='".$v1['id']."'></td>
<td><a href='admin_permission.php?id=".$v1['id']."'>".$v1['name']."</a></td>
</tr>";
}

echo "
</table>                      

<br/>

<div class='form-group'>
<label class='col-sm-2 control-label'>Permission Name:</label>
<div class='col-sm-10 editable'>
<p class='form-control-static' style='display: none;'>Website Name:</p>
<input type='text' class='form-control' name='newPermission' />
</div>
</div>

<button class='btn btn-primary btn-lg openmodal' style='float:right;'>Update Information</button>

</form>
</div>
";
echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>

