<?php
$type = "user";
require_once("../models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$userId = $_GET['id'];
if ($userId == "") {
}else{
$userdetails = fetchUserDetails(NULL, NULL, $userId);
$agentsname = $userdetails['user_name'];
$fname = $userdetails['first_name'];
$sname = $userdetails['second_name'];
$title = "${fname} ${sname} - Upload Loa";
}

if(!empty($_POST))
{
$uploaddir = "/home/content/64/9825564/html/hosting/energybuyersnetwork/users/${userId}/loa/";
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
$successes[] = lang("ACCOUNT_PERMISSION_REMOVED", array ($deletion_count));
} else {
}

}

/////////////////////////////////////////////////////////////navbar
require_once("../includes/header.php");
navbar_user($userId);


echo $before_body;
echo resultBlock($errors,$successes);

if ($userId = "") {
}else{
$userId = $_GET['id'];
echo "
<form action='upload_loa.php?id=".$userId."' method='post' enctype='multipart/form-data'>

<input type='hidden' name='MAX_FILE_SIZE' value='512000' />
Send this file: <input name='userfile' type='file' />
<input type='submit' value='Send File' />
</form>


";
}

echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>
 