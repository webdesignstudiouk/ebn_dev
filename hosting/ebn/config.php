<?php

require_once("db-settings.php");



//Set Settings
$emailActivation = $settings['activation']['value'];
$mail_templates_dir = "models/mail-templates/";
$websiteName = $settings['website_name']['value'];
$websiteUrl = $settings['website_url']['value'];
$emailAddress = $settings['email']['value'];
$resend_activation_threshold = $settings['resend_activation_threshold']['value'];
$emailDate = date('dmy');
$language = $settings['language']['value'];
$template = $settings['template']['value'];

$master_account = -1;

$today = date("d/m/Y");  

$default_hooks = array("#WEBSITENAME#","#WEBSITEURL#","#DATE#");
$default_replace = array($websiteName,$websiteUrl,$emailDate);

if (!file_exists($language)) {
	$language = "models/languages/en.php";
}
 
//Pages to require
require_once("languages/en.php");
require_once("class.mail.php");
require_once("class.email.php");
require_once("class.info.php");
require_once("class.modals.php");
require_once("class.user.php");
require_once("class.newuser.php");
require_once("class.graphs.php");
require_once("funcs.php");  

session_start();


?>
