<?php
$type="admin";
$title="Site Configuration";
require_once("../models/config.php");
require_once("../includes/header.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Forms posted
if(!empty($_POST))
{
$cfgId = array();
$newSettings = $_POST['settings'];

//Validate new site name
if ($newSettings[1] != $websiteName) {
$newWebsiteName = $newSettings[1];
if(minMaxRange(1,150,$newWebsiteName))
{
$errors[] = lang("CONFIG_NAME_CHAR_LIMIT",array(1,150));
}
else if (count($errors) == 0) {
$cfgId[] = 1;
$cfgValue[1] = $newWebsiteName;
$websiteName = $newWebsiteName;
}
}

//Validate new URL
if ($newSettings[2] != $websiteUrl) {
$newWebsiteUrl = $newSettings[2];
if(minMaxRange(1,150,$newWebsiteUrl))
{
$errors[] = lang("CONFIG_URL_CHAR_LIMIT",array(1,150));
}
else if (substr($newWebsiteUrl, -1) != "/"){
$errors[] = lang("CONFIG_INVALID_URL_END");
}
else if (count($errors) == 0) {
$cfgId[] = 2;
$cfgValue[2] = $newWebsiteUrl;
$websiteUrl = $newWebsiteUrl;
}
}

//Validate new site email address
if ($newSettings[3] != $emailAddress) {
$newEmail = $newSettings[3];
if(minMaxRange(1,150,$newEmail))
{
$errors[] = lang("CONFIG_EMAIL_CHAR_LIMIT",array(1,150));
}
elseif(!isValidEmail($newEmail))
{
$errors[] = lang("CONFIG_EMAIL_INVALID");
}
else if (count($errors) == 0) {
$cfgId[] = 3;
$cfgValue[3] = $newEmail;
$emailAddress = $newEmail;
}
}

//Update configuration table with new settings
if (count($errors) == 0 AND count($cfgId) > 0) {
updateConfig($cfgId, $cfgValue);
$successes[] = lang("CONFIG_UPDATE_SUCCESSFUL");
}
}

$languages = getLanguageFiles(); //Retrieve list of language files
$templates = getTemplateFiles(); //Retrieve list of template files
$permissionData = fetchAllPermissions(); //Retrieve list of all permission levels

echo $navbar_admin;
echo $before_body;
echo resultBlock($errors,$successes);

echo "
<div class='user_content'>
<form name='updateAccount' class='form-horizontal user_form' action='".$_SERVER['PHP_SELF']."' method='post'>

<div class='form-group'>
<label class='col-sm-2 control-label'>Website Name:</label>
<div class='col-sm-10 editable'>
<p class='form-control-static' style='display: none;'>Website Name:</p>
<input type='text' class='form-control' name='settings[".$settings['website_name']['id']."]' value='".$websiteName."' />
</div>
</div>

<div class='form-group'>
<label class='col-sm-2 control-label'>Website URL:</label>
<div class='col-sm-10 editable'>
<p class='form-control-static' style='display: none;'>Website URL:</p>
<input type='text' class='form-control' name='settings[".$settings['website_url']['id']."]' value='".$websiteUrl."' />
</div>
</div>

<div class='form-group'>
<label class='col-sm-2 control-label'>Email:</label>
<div class='col-sm-10 editable'>
<p class='form-control-static' style='display: none;'>Email:</p>
<input type='text' class='form-control' name='settings[".$settings['email']['id']."]' value='".$emailAddress."' />
</div>
</div>

<div class='form-group'>
<label class='col-sm-2 control-label'>Activation Threshold:</label>
<div class='col-sm-10 editable'>
<p class='form-control-static' style='display: none;'></p>
<input type='text' class='form-control' name='settings[".$settings['resend_activation_threshold']['id']."]' value='".$resend_activation_threshold."' />
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

