<?php
$type="agent";
$title="Create Prospect";
require_once("../models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}


if(!empty($_POST))
{
$email = trim($_POST["email"]);

$firstname = trim($_POST["first_name"]);
$secondname = trim($_POST["second_name"]);
$phonenumber = trim($_POST["phonenumber"]);
$company = trim($_POST["company"]);
$street = trim($_POST["street"]);
$street1 = trim($_POST["street1"]);
$town = trim($_POST["town"]);
$city = trim($_POST["city"]);
$postcode = trim($_POST["postcode"]);
$position = trim($_POST["position"]);
$captcha = md5($_POST["captcha"]);
$token = generateActivationToken();
$link = mysqli_connect($db_host ,$db_user , $db_pass , $db_name );
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}
mysqli_query($link,"INSERT INTO uc_users (first_name, second_name, email, activation_token, agent_id_sub, phonenumber, company, street, street1, town, city, postcode, position)
VALUES ('" .$firstname. "', '" .$secondname. "', '" .$email. "', '" .$token. "','" .$loggedInUser->user_id. "', '" .$phonenumber. "', '" .$company. "',
 '" .$street. "', '" .$street1. "', '" .$town. "', '" .$city. "', '" .$postcode. "', '" .$position. "')");
$insertedid = mysqli_insert_id($link);

mysqli_query($link,"INSERT INTO uc_user_permission_matches (user_id, permission_id)
VALUES ('" .mysqli_insert_id($link). "', '5' )");

mysqli_query($link,"INSERT INTO uc_newsfeed (type, link, created_by, description)
VALUES ('new_prospect', '" .$insertedid. "', '" .$loggedInUser->fullname. "', 'New Prospect Created')");

mysqli_query($link,"DELETE FROM uc_user_permission_matches WHERE user_id='" .$insertedid. "' AND permission_id='1')");

mysqli_close($link);

header('Location: ../agents/user.php?id='. ${insertedid});

}
require_once("../includes/header.php");


echo $navbar_agents;
echo $before_body;
echo resultBlock($errors,$successes);

echo "
<div class='user_content'>
<form name='adminUser' class='form-horizontal user_form' action='".$_SERVER['PHP_SELF']."' method='post'>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>First Name:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='first_name'/>
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Second Name:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='second_name'/>
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Phone Number:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='phonenumber'/>
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Company:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='company'/>
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Street:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='street'/>
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Street:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='street1'/>
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Town:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='town'/>
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>City:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='city'/>
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Postcode:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='postcode'/>
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Email:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='email'/>
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Position:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='position'/>
</div>
</div>

<button class='btn btn-primary btn-lg openmodal' style='float:right;'>Create Prospect</button>

</form>
</div>";
echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>