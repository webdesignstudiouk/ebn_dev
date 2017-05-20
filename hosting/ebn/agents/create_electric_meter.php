<?php
require_once("../models/config.php");
$type = "user";
$sid = $_GET['sid'];
$title = "Create Meter";
$userId = $_GET['id'];
if (!securePage($_SERVER['PHP_SELF'])){die();}
$metertype = "electric";

//Forms posted
if(!empty($_POST))
{
$v1 = trim($_POST["v1"]);
$v2 = trim($_POST["v2"]);
$v3 = trim($_POST["v3"]);
$v4 = trim($_POST["v4"]);
$v5 = trim($_POST["v5"]);
$v6 = trim($_POST["v6"]);
$v7 = trim($_POST["v7"]);

$mtype = trim($_POST["mtype"]);
$sidv = trim($_POST["site_id"]);
$uid = trim($_POST["user_id"]);
//save site to database
$con=mysqli_connect($db_host, $db_user, $db_pass, "ebndb");
if (mysqli_connect_errno())
{echo "Failed to connect to MySQL: " . mysqli_connect_error();}

mysqli_query($con,"INSERT INTO uc_meters (site_id, v1, v2, v3, v4, v5, v6, v7, type)
VALUES ('" .$sidv . "', '" .$v1. "', '" .$v2. "', '" .$v2. "', '" .$v4. "', '" .$v5. "', '" .$v6. "', '" .$v7. "', '" .$metertype. "')");

$insertedid = mysqli_insert_id($con);

mysqli_query($con,"INSERT INTO uc_newsfeed (type, link, created_by, description)
VALUES ('new_electric_meter', '" .mysqli_insert_id($con). "', '" .$loggedInUser->user_id. "', 'New Electric Meter Created')");

header('Location: sites.php?id='. $uid . '&sid='. $sidv . '&mid='. $insertedid);

mysqli_close($con);
}




require_once("../includes/header.php");
navbaruser($userId, "");


echo $before_body;
echo resultBlock($errors,$successes);

echo"
<form name='adminUser' class='form-horizontal user_form' >
<div class='panel panel-default' style='border-bottom:0px solid #fff!important;'>
<div class='panel-heading'><h4 class='panel-title pull-left'>Electric Meter Details</h4></div>
<div class='panel-body'>
<input type='hidden' class='form-control' name='mtype' value='", $metertype, "'/>
<input type='hidden' class='form-control' name='site_id' value='", $sid, "'>
<input type='hidden' class='form-control' name='user_id' value='", $userId, "'>

<div class='col-sm-4'>
<div class='form-group' style='margin-bottom:15px;'>
<input type='text' data-validation='number length' data-validation-length='min2' maxlength='2' class='form-control' name='v1'/>
</div>
</div>

<div class='col-sm-4'>
<div class='form-group' style='margin-bottom:15px;'>
<input type='text' data-validation='number length' data-validation-length='min3' maxlength='3'  class='form-control' name='v2'/>
</div>
</div>

<div class='col-sm-4'>
<div class='form-group' style='margin-bottom:15px;'>
<input type='text' data-validation='number length' data-validation-length='min3' maxlength='3' class='form-control' name='v3'/>
</div>
</div>

</div>
</div>

<div class='panel panel-default' style='margin-top:0px!important; border-top:0px solid #fff!important;'>
<div class='panel-body' style='padding-top:0px!important;'>

<div class='col-sm-3'>
<div class='form-group' style='margin-bottom:15px;'>
<input type='text' data-validation='number length' data-validation-length='min2' maxlength='2' class='form-control' name='v4'/>
</div>
</div>

<div class='col-sm-3'>
<div class='form-group' style='margin-bottom:15px;'>
<input type='text' data-validation='number length' data-validation-length='min4' maxlength='4' class='form-control' name='v5'/>
</div>
</div>

<div class='col-sm-3'>
<div class='form-group' style='margin-bottom:15px;'>
<input type='text' data-validation='number length' data-validation-length='min4' maxlength='4' class='form-control' name='v6'/>
</div>
</div>

<div class='col-sm-3'>
<div class='form-group' style='margin-bottom:15px;'>
<input type='text' data-validation='number length' data-validation-length='min3' maxlength='3' class='form-control' name='v7'/>
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
 