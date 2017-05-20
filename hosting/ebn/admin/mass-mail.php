<?php
$type = "admin";
$title = "Mass Mail";
require_once("../models/config.php");
$step = $_GET['step'];
$optionget = $_GET['o1'];
$optioncategory = $_GET['o2'];
if ($step == '') {header('Location: mass-mail.php?step=1');}
if (!securePage($_SERVER['PHP_SELF'])){die();}

	//after form submitted
	if(!empty($_POST))
	{
	
	//step1
	if ($step == '1') {
	$get = trim($_POST["get"]);
	header('Location: mass-mail.php?step=2&o1='. $get);
	}
	
	//step2
	if ($step == '2') {
	$o1 = trim($_POST["optionget"]);
	$o2 = trim($_POST["category"]);
	header('Location: mass-mail.php?step=3&o1='.$o1. '&o2='.$o2);
	}
	
	//step3
if ($step == '3') {
$o11 = trim($_POST["o11"]);
$o21 = trim($_POST["o21"]);
$fromemail="Message From The Energy Buyers Network<info@energybuyersnetwork.com>"; // change here if you want
$from=$fromemail;
$headers .= "From: ".$from." ";

$mail_subject=$_POST['mail_subject'];
$email_list=$_POST['email_list'];
$mail_body=$_POST['mail_body'];

$process=explode(",",$email_list);
reset($process);
foreach ($process as $to) {
@mail($to,$mail_subject,$mail_body,$headers);
}			

header("Location: mass-mail.php");
	}
	
	}			

	

//start page
require_once("../includes/header.php");
echo $navbar_admin;
echo $before_body;
echo resultBlock($errors,$successes);

//opening of divs and containers
echo "<section class='container clearfix main_section'>
<div id='main_content_outer' class='clearfix'>
<div id='main_content'>
<div class='row'>
<div class='col-sm-12'>
<form id='wizard_a' class='wizard clearfix' action='".$_SERVER['PHP_SELF']."?step=".$step."' method='post'>
<div class='steps clearfix'><ul role='tablist'>";

//navigation bar (steps 1-3)
if ($step == '1') {echo"
	<li role='tab' class='first current' aria-disabled='false' aria-selected='true'><a id='steps-uid-1-t-0'  aria-controls='steps-uid-1-p-0'>
	<span class='current-info audible'>current step: </span><span class='number'>1</span> Select</a></li>

	<li role='tab' class='disabled' aria-disabled='true'><a id='steps-uid-1-t-1'  aria-controls='steps-uid-1-p-1'>
	<span class='number'>2</span> Category</a></li>

	<li role='tab' class='disabled last' aria-disabled='true'><a id='steps-uid-1-t-2'  aria-controls='steps-uid-1-p-2'>
	<span class='number'>3</span> Mass-Mail</a></li> ";}
elseif ($step == '2') {echo"
	<li role='tab' class='first disabled' aria-disabled='true' aria-selected='true'><a id='steps-uid-1-t-0'  aria-controls='steps-uid-1-p-0'>
	<span class='current-info audible'>current step: </span><span class='number'>1</span> Select</a></li>

	<li role='tab' class='current' aria-disabled='false'><a id='steps-uid-1-t-1'  aria-controls='steps-uid-1-p-1'>
	<span class='number'>2</span> Category</a></li>

	<li role='tab' class='disabled last' aria-disabled='true'><a id='steps-uid-1-t-2'  aria-controls='steps-uid-1-p-2'>
	<span class='number'>3</span> Mass-Mail</a></li> ";}
elseif ($step == '3') {echo"
	<li role='tab' class='first disabled' aria-disabled='true' aria-selected='true'><a id='steps-uid-1-t-0'  aria-controls='steps-uid-1-p-0'>
	<span class='current-info audible'>current step: </span><span class='number'>1</span> Select</a></li>

	<li role='tab' class='disabled' aria-disabled='true'><a id='steps-uid-1-t-1'  aria-controls='steps-uid-1-p-1'>
	<span class='number'>2</span> Category</a></li>

	<li role='tab' class='current last' aria-disabled='false'><a id='steps-uid-1-t-2'  aria-controls='steps-uid-1-p-2'>
	<span class='number'>3</span> Mass-Mail</a></li> ";}	

echo"</ul></div>";

//step 1
if ($step == '1') {

echo"<div class='content clearfix' style='height: 236px;'><h4 id='steps-uid-1-h-0' tabindex='-1' class='title current'>Select</h4>
<fieldset id='steps-uid-1-p-0' role='tabpanel' aria-labelledby='steps-uid-1-h-0' class='body current' aria-hidden='false' style='display: block;'>
<div class='row'><div class='col-sm-3'>
<div class='step_info'><h4>Select</h4>
<p>Select an Agent or 'All' option to set where the information comes from in the next step.<br/><br/> This is the category we pull all the email addresses from for your mass mail.</p></div>
</div><div class='col-sm-9'><div class='form_sep'>
<div class='form-group'>	
<select id='get' name='get' class='form-control'>";

$permissionId = '6';
$permissionData = fetchAllPermissions();
$permissionDetails = fetchPermissionDetails($permissionId);
$permissionUsers = fetchPermissionUsers($permissionId); //Retrieve list of users with membership
$userData = fetchAllUsers(); //Fetch all users

	//foreach ($userData as $v1) {
	//if(isset($permissionUsers[$v1['id']])){
	//echo " 
	//<option value='".$v1['id']."' >".$v1['first_name']." ".$v1['second_name']."</option>
	//";
	//}
	//}

echo"<option value='site'>Site</option></select></div></div></div></div></fieldset>";}

//step 2
if ($step == '2') {

echo"<div class='content clearfix' style='height: 236px;'><h4 id='steps-uid-1-h-0' tabindex='-1' class='title current'>Category</h4>
<fieldset id='steps-uid-1-p-0' role='tabpanel' aria-labelledby='steps-uid-1-h-0' class='body current' aria-hidden='false' style='display: block;'>
<div class='row'><div class='col-sm-3'>
<div class='step_info'><h4>Category</h4>
<p>Please select the report you want to generate. <br/><br/> The next step will concist of you declaring the format you want the report to be generated in.</p></div>
</div><div class='col-sm-9'><div class='form_sep'>
<input type='hidden' name='optionget' value='", $optionget, "'/>
<div class='form-group'>	
<select id='category' name='category' class='form-control'>
	<option value='ac' >All Clients</option>
	</select>
</div>
</div></div></div></fieldset>";}

//step 3
if ($step == '3') {
$userData = fetchAllUsers(); //Fetch information for all users

echo"<div class='content clearfix' style='height: 236px;'><h4 id='steps-uid-1-h-0' tabindex='-1' class='title current'>Mass-Mail</h4>
<fieldset id='steps-uid-1-p-0' role='tabpanel' aria-labelledby='steps-uid-1-h-0' class='body current' aria-hidden='false' style='display: block;'>
<div class='row'><div class='col-sm-3'>
<div class='step_info'><h4>Mass-Mail</h4>
<p>All the emails you have selected will recieve this email. <br/><br/> Just fill in the subject box and the message body you wish to send.</p></div>
</div><div class='col-sm-9'><div class='form_sep'>

<input type='hidden' name='optionget' value='", $optionget, "'/>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Subect:</label>
<div class='col-sm-10 editable'>
<div class='select2-container select2-container-multi' id='s2id_s2_tokenization'>
<ul class='select2-choices'> ";

foreach ($userData as $v1) {
echo"<li class='select2-search-choice'>    <div>";
echo $v1['email'];
echo"</div>    <a href='#' onclick='return false;' class='select2-search-choice-close' tabindex='-1'></a></li>";
}


echo  "
</ul>
</div>
</div>
</div>

<input type='hidden' class='form-control' name='email_list' value='";

foreach ($userData as $v1) {
echo $v1['email'];
echo",";
}

echo"' />

<input type='hidden' name='optioncategory' value='", $optioncategory, "'/>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Subect:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='mail_subject' value='' />
</div>
</div>

<br/>
<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Message:</label>
<div class='col-sm-10 editable'>
<textarea name='mail_body' id='reg_textarea' cols='10' rows='3' class='form-control'></textarea>
</div>
</div>

</div></div></div></fieldset>";}


//pagination and closing of divs/containers
echo"</div><div class='actions clearfix'><ul role='menu' aria-label='Pagination' style='list-style:none;' >";

if ($step == '1') {echo"
<button class='next_step btn btn-default' class='btn btn-primary'>Next</button>";}
elseif ($step == '2') {echo"
<li class='prev_step' aria-hidden='false' aria-disabled='false'><a href='${websiteUrl}admin/mass-mail.php?step=1' class='btn btn-default' role='menuitem'>Previous</a></li>
<button class='next_step btn btn-default' class='btn btn-primary'>Next</button>";}
elseif ($step == '3') {echo"
<br/><li class='prev_step' aria-hidden='false' aria-disabled='false'><a href='${websiteUrl}admin/mass-mail.php?step=2&op=", $optionget, "' class='btn btn-default' role='menuitem'>Previous</a></li>
<button class='next_step btn btn-info' class='btn btn-primary'>Send</button>";}

echo "</ul></div></form></div></div></div></div></section>";

//footer
echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>
