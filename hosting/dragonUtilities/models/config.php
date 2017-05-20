<?php
require_once("db.php");

require_once("funcs.php");

$websiteName = "Dragon Utilities";
$websiteUrl = "http://webdesignstudiouk.com/hosting/acpMoney/";
$contactLink =  "<a href='contactUs.php' >Contact us</a>";
$callbackWidget = "
<form action='scripts/script_callBack.php' id='contact-form' method='post' name='contact-form' novalidate='novalidate' style='margin:0px!important'>
	<fieldset>
		<div id='formstatus'></div>
		<p><input class='span12' id='name' name='name'
		placeholder='Name*' type='text' value=''></p>
		<p><input class='span12' id='email' name='email'
		placeholder='Email*' type='email' value=''></p>
		<p><input class='span12' id='phonenumber' name='phonenumber'
		placeholder='Phone Number*' type='text' value=''></p>

		<p class='last'><input class='btn' id='submit' name=
		'submit' type='submit' value='Submit'></p>
	</fieldset>
</form>
";
?>
 