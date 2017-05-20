<?php
require_once("../models/config.php");
$type = "user";
$userId = $_GET['id'];
$mid = $_GET['mid'];
$sid = $_GET['sid']; 
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Forms posted
if(!empty($_POST))
{
$meter_id = trim($_POST["meter_id"]);
$site_id = trim($_POST["site_id"]);

$loa = trim($_POST["loa"]);
$bill = trim($_POST["bill"]);

$cedconfirmed = trim($_POST["cedconfirmed"]);
$cedconfirmedv = trim($_POST["cedconfirmedv"]);

$eacconfirmed = trim($_POST["eacconfirmed"]);
$eacconfirmedv = trim($_POST["eacconfirmedv"]);

$supplier = trim($_POST["supplier"]);

$terminationlodged = trim($_POST["terminationlodged"]);
$terminationlodgedv = trim($_POST["terminationlodgedv"]);

$terminationacceppted = trim($_POST["terminationacceppted"]);
$terminationaccepptedv = trim($_POST["terminationaccepptedv"]);

$terminationwindowopen = trim($_POST["terminationwindowopen"]);
$terminationwindowopenv = trim($_POST["terminationwindowopenv"]);

$terminationwindowcloses = trim($_POST["terminationwindowcloses"]);
$terminationwindowclosesv = trim($_POST["terminationwindowclosesv"]);

$kva = trim($_POST["kva"]); 
$annualspend = trim($_POST["annualspend"]);

$rate1 = trim($_POST["rate1"]);
$rate2 = trim($_POST["rate2"]);
$rate3 = trim($_POST["rate3"]);
$rate4 = trim($_POST["rate4"]);
$rate5 = trim($_POST["rate5"]);

$nca = trim($_POST["nca"]);
$ncs = trim($_POST["ncs"]);

//save site to database
$con=mysqli_connect($db_host, $db_user, $db_pass, "ebndb");
if (mysqli_connect_errno())
{echo "Failed to connect to MySQL: " . mysqli_connect_error();}

mysqli_query($con,"INSERT INTO uc_contracts (meter_id, loa, bill, cedconfirmed, cedconfirmedv, eacconfirmed, eacconfirmedv, supplier, 
					terminationlodged, terminationlodgedv, terminationacceppted, terminationaccepptedv, terminationwindowopen, terminationwindowopenv,
					terminationwindowcloses, terminationwindowclosesv, kva, annualspend, rate1, rate2, rate3, rate4, rate5, timestamp, user_id, nca, ncs)
		VALUES ('" .$meter_id . "', '" .$loa. "', '" .$bill. "', '" .$cedconfirmed. "', '" .$cedconfirmedv. "', '" .$eacconfirmed. "', '" .$eacconfirmedv. "', 
				'" .$supplier. "', '" .$terminationlodged. "', '" .$terminationlodgedv. "', '" .$terminationacceppted. "', '" .$terminationaccepptedv. "',
				'" .$terminationwindowopen. "', '" .$terminationwindowopenv. "', '" .$terminationwindowcloses. "', '" .$terminationwindowclosesv. "',
				'" .$kva. "', '" .$annualspend. "', '" .$rate1. "', '" .$rate2. "', '" .$rate3. "', '" .$rate4. "', '" .$rate5. "', '" .$today. "', '" .$userId. "', '" .$nca. "', '" .$ncs. "')");

$insertedid = mysqli_insert_id($con);

header('Location: sites.php?id='. ${userId} . '&sid='. ${site_id} . '&mid='. ${meter_id} . '&cid='. ${insertedid});

mysqli_close($con);
}

require_once("../includes/header.php");
navbaruser($userId, "");


echo $before_body;
echo resultBlock($errors,$successes); 

echo "<form name='adminUser' class='form-horizontal user_form' action='".$_SERVER['PHP_SELF']."?id=${userId}&mid=${mid}' method='post'>
<div class='panel panel-default'>
<div class='panel-heading'><h4 class='panel-title pull-left'>Create Contract</h4></div>
<div class='panel-body'>

<input type='hidden' class='form-control' name='site_id' value='", $sid, "'>
<input type='hidden' class='form-control' name='meter_id' value='", $mid, "'>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>New Contract Agreed:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' id='datepickernca' class='form-control' name='nca'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>New Contract Start:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' id='datepickerncs' class='form-control' name='ncs'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>LOA:</label>
<div class='col-sm-1'><center>
<input type='checkbox' id='loa' name='loa' value='yes'>
</center></div><div class='col-sm-8'>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Bill:</label>
<div class='col-sm-1'><center>
<input type='checkbox' id='bill' name='bill' value='yes'>
</center></div><div class='col-sm-8'>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>CED Confirmed:</label>
<div class='col-sm-1'><center>
<input type='checkbox' id='cedconfirmedv' name='cedconfirmedv' value='yes'>
</center></div><div class='col-sm-8'>
<input type='text' id='datepickercedconfirmed' class='form-control' name='cedconfirmed'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>EAC Confirmed:</label>
<div class='col-sm-1'><center>
<input type='checkbox' id='eacconfirmedv' name='eacconfirmedv' value='yes'>
</center></div><div class='col-sm-8'>
<input type='text' id='datepickereacconfirmed' class='form-control' name='eacconfirmed'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Supplier:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='supplier'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Termination Lodged:</label>
<div class='col-sm-1'><center>
<input type='checkbox' id='terminationlodgedv' name='terminationlodgedv' value='yes'>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='terminationlodged'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Termination Accepted:</label>
<div class='col-sm-1'><center>
<input type='checkbox' id='terminationaccepptedv' name='terminationaccepptedv' value='yes'>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='terminationacceppted'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Termination Window Open:</label>
<div class='col-sm-1'><center>
<input type='checkbox' id='terminationwindowopenv' name='terminationwindowopenv' value='yes'>
</center></div><div class='col-sm-8'>
<input type='text' id='datepickeropen' class='form-control' name='terminationwindowopen'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Termination Window Closes:</label>
<div class='col-sm-1'><center>
<input type='checkbox' id='terminationwindowclosesv' name='terminationwindowclosesv' value='yes'>
</center></div><div class='col-sm-8'>
<input type='text' id='datepickerclose' class='form-control' name='terminationwindowcloses'/>
</div></div> 


<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Rate 1:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='rate1'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Rate 2:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='rate2'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Rate 3:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='rate3'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Rate 4:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='rate4'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Rate 5:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='rate5'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>KVA:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='kva'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Annual Spend:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='annualspend'/>
</div></div>

</div>
</div>

</br>
<button class='btn btn-primary btn-lg openmodal' style='float:right;'>Create Contract</button>

</form>
";
 

echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>
  