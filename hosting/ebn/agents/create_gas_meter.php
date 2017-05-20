<?php
require_once("../models/config.php");
$type = "user";
$userId = $_GET['id'];
$sid = $_GET['sid'];
$userdetails = fetchUserDetails(NULL, NULL, $userId);
$agentsname = $userdetails['user_name'];
$fname = $userdetails['first_name'];
$sname = $userdetails['second_name'];
$title = "${fname} ${sname} - Create Meter";
$sites = fetchusersites($userId);
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Forms posted
if(!empty($_POST))
{
$v1 = trim($_POST["v1"]);
$sid = $_GET['sid'];

//save site to database
$con=mysqli_connect($db_host, $db_user, $db_pass, "ebndb");
if (mysqli_connect_errno())
{echo "Failed to connect to MySQL: " . mysqli_connect_error();}

mysqli_query($con,"INSERT INTO uc_meters (site_id, v1, type)
VALUES ('" .$sid . "', '" .$v1. "', '" .$metertype. "')");

$insertedid = mysqli_insert_id($con);

mysqli_query($con,"INSERT INTO uc_newsfeed (type, link, created_by, description)
VALUES ('new_gas_meter', '" .mysqli_insert_id($con). "', '" .$loggedInUser->user_id. "', 'New Gas Meter Created')");

header('Location: sites.php?id='. $userId . '&sid='. $sid . '&mid='. $insertedid);

mysqli_close($con);
}




require_once("../includes/header.php");
navbaruser($userId, "");


echo $before_body;
echo resultBlock($errors,$successes);

echo"
<form name='adminUser' class='form-horizontal user_form' action='".$_SERVER['PHP_SELF']."?id=${userId}&sid=${sid}' method='post'>
<div class='panel panel-default'>
<div class='panel-heading'><h4 class='panel-title pull-left'>Gas Meter Details</h4></div>
<div class='panel-body'>

<div class='col-sm-12'>
<div class='form-group' style='margin-bottom:15px;'>
<input type='text' class='form-control' data-validation='number length' data-validation-length='min10' maxlength='10' id='v1' name='v1'/>
</div>
</div>

</div>
</div>

<br/>
<button class='btn btn-primary btn-lg' style='float:right;'>Create Meter</button>
</form>

<script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src='", $websiteUrl, "assets/form-validator/jquery.form-validator.min.js'></script>
<script> $.validate(); </script>";

echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>
 