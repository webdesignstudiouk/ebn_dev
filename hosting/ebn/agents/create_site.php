<?php
require_once("../models/config.php");
$type = "user";
$userId = $_GET['id'];
$userdetails = fetchUserDetails(NULL, NULL, $userId);
$agentsname = $userdetails['user_name'];
$fname = $userdetails['first_name'];
$sname = $userdetails['second_name'];
$title = "${fname} ${sname} - Create Site";
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Forms posted
if(!empty($_POST))
{	
$name = trim($_POST["name"]);
$company = trim($_POST["company"]);
$street = trim($_POST["street"]);
$town = trim($_POST["town"]);
$city = trim($_POST["city"]);
$postcode = trim($_POST["postcode"]);

//save site to database
$con=mysqli_connect($db_host, $db_user, $db_pass, "ebndb");
if (mysqli_connect_errno())
{echo "Failed to connect to MySQL: " . mysqli_connect_error();}
mysqli_query($con,"INSERT INTO uc_sites (user_id, name, company, street, town, city, postcode)
VALUES ('" .$userId. "', '" .$name. "', '" .$company. "', '" .$street. "', '" .$town. "', '" .$city. "', '" .$postcode. "')");

$insertedid = mysqli_insert_id($con);

mysqli_query($con,"INSERT INTO uc_newsfeed (type, link, created_by, description)
VALUES ('new_site', '" .$insertedid. "', '" .$loggedInUser->user_id. "', 'New Site Created')");

mysqli_close($con);

header('Location: sites.php?id='. $userId . '&sid=' . $insertedid );
}


require_once("../includes/header.php");
navbaruser($userId, "");


echo $before_body;
echo resultBlock($errors,$successes);

echo "
<div class='user_content'>
<form name='adminUser' class='form-horizontal user_form' action='".$_SERVER['PHP_SELF']."?id=${userId}' method='post'>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Name:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='name'/>
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



<button class='btn btn-primary btn-lg openmodal' style='float:right;'>Create Site</button>


</form>
</div>
";

echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>
 