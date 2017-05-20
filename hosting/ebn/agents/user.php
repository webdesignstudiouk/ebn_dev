<?php
$type = "user";
require_once("../models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$userId = $_GET['id'];
$userdetails = fetchUserDetails(NULL, NULL, $userId);
$agentsname = $userdetails['user_name'];
$company = $userdetails['company'];
$agentfname = $loggedInUser->firstname;
$agentsname = $loggedInUser->secondname;
$title = "${agentfname} ${agentsname} > Dashboard > Prospect Details > ${company} ";
$type="agent"; 
 
//Forms posted
if(!empty($_POST)) 
{	

//assign variables from the info of the form
$errors = array();
$successes = array();
$password = $_POST["password"];
$password_new = $_POST["passwordc"];
$password_confirm = $_POST["passwordcheck"];
$agent = $_POST["agent"];
$subagent = $_POST["agent_id_sub"];
$firstname = $_POST["first_name"];
$secondname = $_POST["second_name"];
$phonenumber = $_POST["phonenumber"];
$company = $_POST["company"];
$agent= $_POST["agent"];
$street = $_POST["street"];
$street1 = $_POST["street1"];
$town = $_POST["town"];
$city = $_POST["city"];
$postcode = $_POST["postcode"];
$position = $_POST["position"];
$errors = array();
$email = $_POST["email"];

//Delete selected account
if(!empty($_POST['delete'])){ $deletions = $_POST['delete'];
if ($deletion_count = deleteUsers($deletions)) {
$successes[] = lang("ACCOUNT_DELETIONS_SUCCESSFUL", array($deletion_count));
} else { $errors[] = lang("SQL_ERROR"); }
}

//Activate account
if(isset($_POST['activate']) && $_POST['activate'] == "activate"){
if (setUserActive($userdetails['activation_token'])){
$firstnamemail =$userdetails['first_name'];	
$usernamemail =$userdetails['user_name'];			
$emailmail = $userdetails['email'];	

$successes[] = lang("ACCOUNT_MANUALLY_ACTIVATED", array($first_name));
$fromemail="members@energybuyersnetwork.com"; 
$sub="Your Account Is Active";          
$errors = array();
$toemail = $userdetails['email'];	


$contentmsg=stripslashes("       

$emailheader

<tr>          
<td valign='top' width='50' height='41' bgcolor='#ffffff'>&nbsp;</td>          
<td valign='top' width='391' height='41' colspan='2' bgcolor='#ffffff'>            
<p style='font-family:georgia;font-size:12px;font-style:italic;color:#000000;'>Hello $firstnamemail</p>            
<p style='font-family:georgia;font-size:12px;font-style:italic;color:#000000;'>
Your account has been activated. Please log in now.
</p>         

<p style='font-family:helvetica;font-size:12px;font-weight:bold;color:#000000;'>YOUR ACCOUNT DETAILS ARE BELOW:<br>              
<span style='font-weight:normal;'></span></p>              
<table width='100%' cellpadding='6' cellspacing='0' border='0' bgcolor='#ffffff' style='font-family:helvetica;font-size:12px;font-weight:bold;color:#000000;'>                
<tbody>

<tr>                  
<td width='60%' align='left' valign='middle' style='border-bottom:1px solid #aaaaaa;border-top:1px solid #aaaaaa;'>Label</td>   
<td width='10%' align='left' valign='middle' nowrap='' style='border-bottom:1px solid #aaaaaa;border-top:1px solid #aaaaaa;'>&nbsp;</td>    
<td width='10%' align='left' valign='middle' nowrap='' style='border-bottom:1px solid #aaaaaa;border-top:1px solid #aaaaaa;'>Value</td>  
<td width='10%' align='left' valign='middle' nowrap='' style='border-bottom:1px solid #aaaaaa;border-top:1px solid #aaaaaa;'>&nbsp;</td>    

</tr>                                

<tr><td class='body' valign='top'>Username:</td><td class='body' valign='top'>&nbsp;</td>
<td align='left' class='body' valign='top'>$usernamemail</td><td align='right' class='body' valign='top'>&nbsp;</td></tr>

<tr><td class='body' valign='top'>Email:</td><td class='body' valign='top'>&nbsp;</td>
<td align='left' class='body' valign='top'>$emailmail</td><td align='right' class='body' valign='top'>&nbsp;</td></tr>

<tr>                                
</tbody>
</table>     
</br>	
<center>
<p style='font-family:helvetica;font-size:12px;'>Thank you for registering and we will be in touch as quick as we can.</p>				
<p style='font-family:helvetica;font-size:12px;font-weight:bold;color:#000000;'>The Energy Buyers Network Team!</p>  
</center>                  
</td>        
</tr>        

$emailfooter 

");
		$headers  = "MIME-Version: 1.0";
		$headers .= "Content-type: text/html; charset=iso-8859-1";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";	

$from=$fromemail;
$headers .= "From: ".$from." ";
@mail($toemail,$sub,$contentmsg,$headers);

} else { $errors[] = lang("SQL_ERROR"); }
}

//Remove permission level
if(!empty($_POST['removePermission'])){ $remove = $_POST['removePermission'];
if ($deletion_count = removePermission($remove, $userId)){
$successes[] = lang("ACCOUNT_PERMISSION_REMOVED", array ($deletion_count));
} else { $errors[] = lang("SQL_ERROR"); }
}

//Add permission level
if(!empty($_POST['addPermission'])){ $add = $_POST['addPermission'];
if ($addition_count = addPermission($add, $userId)){
$successes[] = lang("ACCOUNT_PERMISSION_ADDED", array ($addition_count));
}else { $errors[] = lang("SQL_ERROR");}
}

//If First Name Has Been Updated
if($userdetails["first_name"] == $firstname){}
else{updateuserinfo($userId, "first_name", $firstname);
$successes[] = lang("FIRST_NAME_UPDATED");}

//If Second Name Has Been Updated
if($userdetails["second_name"] == $secondname){}
else{updateuserinfo($userId, "second_name", $secondname);
$successes[] = lang("SECOND_NAME_UPDATED");}

//If Phonenumber Has Been Updated
if($userdetails["phonenumber"] == $phonenumber){}
else{updateuserinfo($userId, "phonenumber", $phonenumber);
$successes[] = lang("PHONENUMBER_UPDATED");}

//If Company Has Been Updated
if($userdetails["company"] == $company){}
else{updateuserinfo($userId, "company", $company);
$successes[] = lang("COMPANY_UPDATED");}

//If Street Has Been Updated
if($userdetails["street"] == $street){}
else{updateuserinfo($userId, "street", $street);
$successes[] = lang("STREET_UPDATED");}

//If Street1 Has Been Updated
if($userdetails["street1"] == $street1){}
else{updateuserinfo($userId, "street1", $street1);
$successes[] = lang("STREET_UPDATED");}
	
//If Town Has Been Updated
if($userdetails["town"] == $town){}
else{updateuserinfo($userId, "town", $town);
$successes[] = lang("TOWN_UPDATED");}	

//If City Has Been Updated
if($userdetails["city"] == $city){}
else{updateuserinfo($userId, "city", $city);
$successes[] = lang("CITY_UPDATED");}	

//If postcode Has Been Updated
if($userdetails["postcode"] == $postcode){}
else{updateuserinfo($userId, "postcode", $postcode);
$successes[] = lang("POSTCODE_UPDATED");}	

//If postcode Has Been Updated
if($userdetails["position"] == $position){}
else{updateuserinfo($userId, "position", $position);
$successes[] = lang("POSITION_UPDATED");}	

//If postcode Has Been Updated
if($userdetails["email"] == $email){}
else{updateuserinfo($userId, "email", $email);
$successes[] = lang("EMAIL_UPDATED");}	


if ($agent == "null" or $subagent == "null"){}else{
if ($userdetails['agent'] == "") {
	//If subagent Has Been Updated
	if($userdetails["agent_id_sub"] == $subagent){}
	else{updateuserinfo($userId, "agent_id_sub", $subagent);
	$successes[] = lang("AGENT_UPDATED");}	
}
elseif ($userdetails['agent_id_sub'] == "") {
	//If agent Has Been Updated
	if($userdetails["agent"] == $agent){}
	else{updateuserinfo($userId, "agent", $agent);
	$successes[] = lang("AGENT_UPDATED");}	
}
}

//update if there is no errors
if(count($errors) == 0 AND count($successes) == 0){
$successes[] = lang("ACCOUNT_INFORMATION_UPDATED");
header('Location: user.php?id='. $userId);
}
}

//get information of the users permissions
$userPermission = fetchUserPermissions($userId);
$permissionData = fetchAllPermissions();

/////////////////////////////////////////////////////////////navbar
require_once("../includes/header.php");
navbaruser($userId, "details");
 

echo $before_body;
echo resultBlock($errors,$successes);

echo "
<div class='user_content' style='border-top:0px solid #fff!important;'>
<form name='adminUser' class='form-horizontal user_form' action='user.php?id=".$userId."' method='post'>


<ul class='nav nav-tabs' style='border-bottom:0px solid #fff!important;'>
<li class='active'><a data-toggle='tab' href='#tbb_a'>General</a></li>
<li class=''><a data-toggle='tab' href='#tbb_b'>Contact Details</a></li>
<li class=''><a data-toggle='tab' href='#tbb_c'>Address</a></li>";
if (haspermission($loggedInUser->user_id, "2") == true){
echo"<li class=''><a data-toggle='tab' href='#tbb_d'>Permissions</a></li>
<li class=''><a data-toggle='tab' href='#tbb_e'>Agent</a></li>";
}
echo"</ul>

<div class='tab-content' style='min-height:300px;'>

<div id='tbb_a' class='tab-pane active'>


<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>User Name:</label>
<div class='col-sm-10 editable'>
<p>".$userdetails['user_name']."</p>
</div>
</div>
";

echo "


<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>First Name:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='first_name' value='".$userdetails["first_name"]."' />
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Second Name:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='second_name' value='".$userdetails["second_name"]."' />
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Position:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='position' value='".$userdetails["position"]."' />
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Active:</label>
<div class='col-sm-10 editable'>";
if ($userdetails['active'] == '1'){ echo "<p>This User Is Currently Activated</p>";	}
else{ echo "<input type='checkbox' name='activate' id='activate' value='activate'>";}
echo "</div></div>";

echo "<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Sign Up:</label>
<div class='col-sm-10 editable'>
<p>".date("j M, Y", $userdetails['sign_up_stamp'])."</p>
</div></div> 

</div>
<div id='tbb_b' class='tab-pane'>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Email:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='email' value='".$userdetails["email"]."' />
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Phone Number:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='phonenumber' value='".$userdetails["phonenumber"]."' />
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Company:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control'name='company' value='".$userdetails["company"]."' />
</div>
</div>

</div>
<div id='tbb_c' class='tab-pane'>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Street:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='street' value='".$userdetails["street"]."' />
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Street:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='street1' value='".$userdetails["street1"]."' />
</div>
</div>
 
<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Town:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control'name='town' value='".$userdetails["town"]."' />
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>City:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control'name='city' value='".$userdetails["city"]."' />
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Postcode:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control'name='postcode' value='".$userdetails["postcode"]."' />
</div>
</div>

</div>
<div id='tbb_d' class='tab-pane'>";



echo "
<table class='table table-condensed'>
<thead>
<tr>
<th>Remove Permission</th>
<th>Add Permission</th>
</tr>
</thead><tr><td>";

//List of permission levels user is apart of
foreach ($permissionData as $v1) {
if(isset($userPermission[$v1['id']])){
echo "<input type='checkbox' name='removePermission[".$v1['id']."]' id='removePermission[".$v1['id']."]' value='".$v1['id']."'> ".$v1['name'];
echo "</br>";
}
}
echo "
</td><td>";

//List of permission levels user is not apart of
foreach ($permissionData as $v1) {
if(!isset($userPermission[$v1['id']])){
echo "<input type='checkbox' name='addPermission[".$v1['id']."]' id='addPermission[".$v1['id']."]' value='".$v1['id']."'> ".$v1['name'];
echo "</br>";
}
}
echo "
</td></tr>
</tbody>
</table>

</div>";


echo" <div id='tbb_e' class='tab-pane'>";

if ($userdetails['agent'] == "") {
$permissionId = "6";
$pagePermissions = fetchPermissionPages($permissionId); //Retrieve list of accessible pages
$permissionUsers = fetchPermissionUsers($permissionId); //Retrieve list of users with membership
$userData = fetchAllUsers(); //Fetch all users
$pageData = fetchAllPages(); //Fetch all pages
$userdetailsubagent = fetchUserDetails(NULL, NULL, $userdetails['agent_id_sub']);
echo"<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Current Assigned Agent:</label>
<p><a href='user.php?id=", $userdetailsubagent['id'], "'>", $userdetailsubagent['first_name'], " ", $userdetailsubagent['second_name'], "</a></p>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Agent:</label>
<div class='col-sm-10 editable'>
<select id='reg_select' name='agent_id_sub' class='form-control'>
<option value='null'>Please Select An Agent</option>";
foreach ($userData as $v1) {
	if(isset($permissionUsers[$v1['id']])){
		echo "<option value='", $v1['id'], "'>", $v1['first_name'], " ", $v1['second_name'], "</option>";
	}
}
echo"</select>
</div>
</div>";
}
elseif ($userdetails['agent_id_sub'] == "") {
$permissionId = "6";
$pagePermissions = fetchPermissionPages($permissionId); //Retrieve list of accessible pages
$permissionUsers = fetchPermissionUsers($permissionId); //Retrieve list of users with membership
$userData = fetchAllUsers(); //Fetch all users
$pageData = fetchAllPages(); //Fetch all pages
$userdetailsubagent = fetchUserDetails(NULL, NULL, $userdetails['agent']);
echo"<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Current Assigned Agent:</label>
<p><a href='user.php?id=", $userdetailsubagent['id'], "'>", $userdetailsubagent['first_name'], " ", $userdetailsubagent['second_name'], "</a></p>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Agent:</label>
<div class='col-sm-10 editable'>
<select id='reg_select' name='agent'class='form-control'>
<option value='null'>Please Select An Agent</option>";
foreach ($userData as $v1) {
	if(isset($permissionUsers[$v1['id']])){
		echo "<option value='", $v1['id'], "'>", $v1['first_name'], " ", $v1['second_name'], "</option>";
	}
}
echo"</select>
</div>
</div>";
}
echo"</div>";




echo"</div>";




 



echo"
<button class='btn btn-primary btn-lg openmodal' style='float:right;'>Update Information</button>
</form>
</body>
</html>";

echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>
 