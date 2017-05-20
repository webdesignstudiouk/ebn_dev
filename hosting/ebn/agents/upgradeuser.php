<?php
require_once("../models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$userId = $_GET['id'];
$userdetails = fetchUserDetails(NULL, NULL, $userId);
$title = "Upgrade User";
$type = "agent";

if(!empty($_POST))
{

$rand_pass = getUniqueCode(15); //Get unique code
$secure_pass = generateHash($rand_pass); //Generate random hash
$mail = new userCakeMail();		

//Setup our custom hooks
$hooks = array(
"searchStrs" => array("#GENERATED-PASS#","#USERNAME#"),
"subjectStrs" => array($rand_pass,$userdetails["first_name"])
);

if(!$mail->newTemplateMsg("your-lost-password.txt",$hooks))
{
$errors[] = lang("MAIL_TEMPLATE_BUILD_ERROR");
}
else
{	
if(!$mail->sendMail($userdetails["email"],"Your new password"))
{
$errors[] = lang("MAIL_ERROR");
}
else
{
if(!updatePasswordFromToken($secure_pass,$userdetails["activation_token"]))
{
$errors[] = lang("SQL_ERROR");
}
else {
$successes[]  = lang("FORGOTPASS_NEW_PASS_EMAIL");
}
}
}
removePermission("5", $userId);

$link = mysqli_connect($db_host ,$db_user , $db_pass , $db_name );
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}
mysqli_query($link,"INSERT INTO uc_user_permission_matches (user_id, permission_id) VALUES ('" .$userId. "', '1' )");

mysqli_close($link);
header('Location: ../agents/user.php?id='. ${userId});
$un1 = $userdetails['first_name'];
$un2 = $userdetails['second_name'];
$un3 = $userdetails['id'];
$newusername = "$un1.$un2.$un3";

updateuserinfo($userId, "user_name", $newusername);

updatesubagent($userId, "");
updateagent($userId, $loggedInUser->user_id);
}


require_once("../includes/header.php");
navbaruser($userId, "upgrade");
echo $before_body;

echo resultBlock($errors,$successes);

echo "

<div class='user_content'>
<form name='updateAccount' class='form-horizontal user_form' action='".$_SERVER['PHP_SELF']."?id=", $userId, "' method='post'>

<p>This user is currently a prospect this feature will upgrade this prospect to a user and add the functionality to login and use this system, before doing so some extra
information is needed. Please fill in the users desired credentials and the prospect will then become a functioning user (all site, meter, contract data will be kept.</p>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Password:</label>
<div class='col-sm-10 editable'>
<input  class='form-control' type='password' name='password' />
</div>
</div>

</div>
</div>



<button class='btn btn-primary btn-lg openmodal' style='float:right;'>Upgrade User</button>";

echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>