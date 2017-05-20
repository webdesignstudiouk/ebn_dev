<?php
require_once("../models/config.php");
require_once("../assets/scripts/progressbar_sites.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$userId = $_GET['id'];
$id = $_GET['id'];
$sid = $_GET['sid'];
$mid = $_GET['mid'];
$cid = $_GET['cid'];
$userdetails = fetchUserDetails(NULL, NULL, $id);
$fname = $userdetails['first_name'];
$sname = $userdetails['second_name'];
$userdetails = fetchUserDetails(NULL, NULL, $userId);
$agentsname = $userdetails['user_name'];
$company = $userdetails['company'];
$agentfname = $loggedInUser->firstname;
$agentsname = $loggedInUser->secondname; 
$title = "${agentfname} ${agentsname} > Dashboard > Prospect Details > ${company} > Sites";
$type = "agent";

//fetch sites 
if ($id == '') {}
else {
$sites = fetchusersites($id);
} 

//fetch site details
if ($sid == '') {}
else {
$meters = fetchsitemeters($sid);
$sitedetails = fetchSiteDetails($sid);
}

//fetch meter details
if ($mid == '') {}
else {
$contracts = fetchmetercontracts($mid);
$meterdetails = fetchMeterDetails($mid);
}

//fetch contract details
if ($cid == '') {}
else {
$contractdetails = fetchContractDetails($cid);
}

if(!empty($_POST))
{
//siteinfo
if ($sid == '') {}else{
$name = trim($_POST["name"]);
$company = trim($_POST["company"]);
$street = trim($_POST["street"]);
$town= trim($_POST["town"]);
$city = trim($_POST["city"]);
$postcode = trim($_POST["postcode"]);

updatesiteinfo($sid, "name", $name);
updatesiteinfo($sid, "company", $company);
updatesiteinfo($sid, "street", $street);
updatesiteinfo($sid, "town", $town);
updatesiteinfo($sid, "city", $city);
updatesiteinfo($sid, "postcode", $postcode);
}

//meterinfo
if ($mid == '') {}else{
$meterid = trim($_POST["meter"]);
$v1 = trim($_POST["v1"]);
$v2 = trim($_POST["v2"]);
$v3 = trim($_POST["v3"]);
$v4 = trim($_POST["v4"]);
$v5 = trim($_POST["v5"]);
$v6 = trim($_POST["v6"]);
$v7 = trim($_POST["v7"]);	

updatemeterinfo ($mid, "v1", $v1);
updatemeterinfo ($mid, "v2", $v2);
updatemeterinfo ($mid, "v3", $v3);
updatemeterinfo ($mid, "v4", $v4);
updatemeterinfo ($mid, "v5", $v5);
updatemeterinfo ($mid, "v6", $v6);
updatemeterinfo ($mid, "v7", $v7);
}

//contractinfo
if ($cid == '') {}else{
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

updatecontractinfo ($cid, "loa", $loa);
updatecontractinfo ($cid, "bill", $bill);
updatecontractinfo ($cid, "cedconfirmed", $cedconfirmed);
updatecontractinfo ($cid, "cedconfirmedv", $cedconfirmedv);
updatecontractinfo ($cid, "eacconfirmed", $eacconfirmed);
updatecontractinfo ($cid, "eacconfirmedv", $eacconfirmedv);
updatecontractinfo ($cid, "supplier", $supplier);
updatecontractinfo ($cid, "terminationlodged", $terminationlodged);
updatecontractinfo ($cid, "terminationlodgedv", $terminationlodgedv);
updatecontractinfo ($cid, "terminationacceppted", $terminationacceppted);
updatecontractinfo ($cid, "terminationaccepptedv", $terminationaccepptedv);
updatecontractinfo ($cid, "terminationwindowopen", $terminationwindowopen);
updatecontractinfo ($cid, "terminationwindowopenv", $terminationwindowopenv);
updatecontractinfo ($cid, "terminationwindowcloses", $terminationwindowcloses);
updatecontractinfo ($cid, "terminationwindowclosesv", $terminationwindowclosesv);
updatecontractinfo ($cid, "kva", $kva);
updatecontractinfo ($cid, "annualspend", $annualspend);
updatecontractinfo ($cid, "rate1", $rate1);
updatecontractinfo ($cid, "rate2", $rate2);
updatecontractinfo ($cid, "rate3", $rate3);
updatecontractinfo ($cid, "rate4", $rate4);
updatecontractinfo ($cid, "rate5", $rate5);
updatecontractinfo ($cid, "nca", $nca);
updatecontractinfo ($cid, "ncs", $ncs);
}
header('Location: sites.php?id='. $id . '&sid='. $sid . '&mid='. $mid . '&cid='. $cid );
}

/////////////////////////////////////////////////////////////navbar and active class functions
$link ="3";

function active($link) {
$sid = $_GET['sid'];
if($link==$sid) { echo " class='active'"; }
}

function activem($link) {
$mid = $_GET['mid'];
if($link==$mid) { echo " class='active'";}
}


require_once("../includes/header.php");
navbaruser($userId, "sites");
echo $before_body;
echo resultBlock($errors,$successes);


/////////////////////////////////////////////////////////////////////////////////Site Nav and Info!
if ($id == '') {}else{
echo "<div class='row'>
<div class='col-sm-4 col-md-2'>
<div class='mailbox_nav'>
<div class='sepH_b'>
<a href='create_site.php?id=", $id, "' class='btn btn-default btn-sm' style='width:100%;'>Create A New Site</a>
</div>
<ul class='nav nav-pills nav-stacked' style=' height:300px; overflow: auto;'>";

if(!usersiteid($id)){
echo "No sites for this user";
}else {
foreach ($sites as $v1) {
echo "<li", active($v1['id']), "><a href='sites.php?id=", $id, "&sid=", $v1['id'], "'>";
echo $v1['name'];
echo "</a></li>";
}
}
echo "</ul></div></div>";
echo "<div class='col-sm-8 col-md-10'>";

if ($sid == '') {
echo "<table id='mailbox_table' class='table toggle-square footable-loaded footable default' 
data-filter='#mailbox_search' data-page-size='20' data-provides='rowlink'>
<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
<p>Please click a site to view its details (Use the navigation menu to your left)</p></div>
</table>";
}else{
echo "
<form class='form-horizontal user_form' action='".$_SERVER['PHP_SELF']."?id=".$id."&sid=".$sid."&mid=".$mid."&cid=".$cid."' method='post'>

<div class='panel panel-default' style=' height:350px;'>
<div class='panel-heading' style='padding:0px!important;'>

<div style='width:100%; height:100%;'>
<div class='progress-bar progress-bar-info' style='width:";
progressbar_sites ($sid);
echo"%'><h4 class='panel-title pull-left' style='padding-left:10px; width:700px; text-align:left'>Site Details - ";
progressbar_sites ($sid);
echo "% Complete</h4></div></div>
</div>

<div class='panel-body'>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Name:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='name' value='", $sitedetails['name'], "'>
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Company:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='company' value='", $sitedetails['company'], "'>
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Street:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='street' value='", $sitedetails['street'], "'>
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Town:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='town' value='", $sitedetails['town'], "'>
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>City:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='city' value='", $sitedetails['city'], "'>
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Postcode:</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='postcode' value='", $sitedetails['postcode'], "'>
</div>

</div>
</div>";
}
echo "</div></div></div> <hr style='height:1px;' /> ";


/////////////////////////////////////////////////////////////////////////////////Meter Nav and Info!
if ($sid == '') {}else{
echo "<div class='row'>
<div class='col-sm-4 col-md-2'>
<div class='mailbox_nav'>
<div class='sepH_b'>
<a href='create_meter.php?id=", $id, "&sid=", $sid, "' class='btn btn-default btn-sm' style='width:100%;'>Create A New Meter</a>
</div>
<ul class='nav nav-pills nav-stacked' style=' height:300px; overflow: auto;'>";


if(!countusersmeters ($sid)){
echo "No Meters for this Site";
}else {
foreach ($meters as $v1) {
echo "<li", activem($v1['id']), "><a href='sites.php?id=", $id, "&sid=", $sid, "&mid=", $v1['id'], "'>";
echo $v1['id'];
echo "</a></li>";
}
}
 
echo "</ul></div></div>";
echo "<div class='col-sm-8 col-md-10'>";

if ($mid == '') {
echo "
<table id='mailbox_table' class='table toggle-square footable-loaded footable default' 
data-filter='#mailbox_search' data-page-size='20' data-provides='rowlink'>
<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
<p>Please click a Meter to view its details (Use the navigation menu to your left)</p></div>
</table>";
}
else{

if ($meterdetails['type'] == 'electric') {
echo "

<div class='panel panel-default' style=' height:350px;'>
<div class='panel-heading' style='padding:0px!important;'>

<div style='width:100%; height:100%;'>
<div class='progress-bar progress-bar-info' style='width:";
progressbar_emeter ($mid);
echo"%'><h4 class='panel-title pull-left' style='padding-left:10px; width:700px; text-align:left'>Electric Meter Details - ";
progressbar_emeter ($mid);
echo "% Complete</h4></div></div>
</div>
<div class='panel-body'>

<input type='hidden' class='form-control' name='meterid' value='", $meterdetails['id'], "'>

<div class='col-sm-4'>
<div class='form-group' style='margin-bottom:15px;'>
<input type='text' class='form-control' name='v1' value='", $meterdetails['v1'], "'/>
</div>
</div>

<div class='col-sm-4'>
<div class='form-group' style='margin-bottom:15px;'>
<input type='text' class='form-control' name='v2' value='", $meterdetails['v2'], "'/>
</div>
</div>

<div class='col-sm-4'>
<div class='form-group' style='margin-bottom:15px;'>
<input type='text' class='form-control' name='v3' value='", $meterdetails['v3'], "'/>
</div>
</div>

<div class='col-sm-3'>
<div class='form-group' style='margin-bottom:15px;'>
<input type='text' class='form-control' name='v4' value='", $meterdetails['v4'], "'/>
</div>
</div>

<div class='col-sm-3'>
<div class='form-group' style='margin-bottom:15px;'>
<input type='text' class='form-control' name='v5' value='", $meterdetails['v5'], "'/>
</div>
</div>

<div class='col-sm-3'>
<div class='form-group' style='margin-bottom:15px;'>
<input type='text' class='form-control' name='v6' value='", $meterdetails['v6'], "'/>
</div>
</div>

<div class='col-sm-3'>
<div class='form-group' style='margin-bottom:15px;'>
<input type='text' class='form-control' name='v7' value='", $meterdetails['v7'], "'/>
</div>
</div>

</div>
</div> 
";
}else{
echo "
<div class='form-horizontal user_form'>
<div class='panel panel-default' style=' height:350px;'>
<div class='panel-heading' style='padding:0px!important;'>

<div style='width:100%; height:100%;'>
<div class='progress-bar progress-bar-info' style='width:";
progressbar_gmeter ($mid);
echo"%'><h4 class='panel-title pull-left' style='padding-left:10px; width:700px; text-align:left' >Gas Meter Details - ";
progressbar_gmeter ($mid);
echo "% Complete</h4></div></div>
</div>

<div class='panel-body'>
<input type='hidden' class='form-control' name='meterid' value='", $meterdetails['id'], "'>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>v1</label>
<div class='col-sm-10 editable'>
<input type='text' class='form-control' name='v1' value='", $meterdetails['v1'], "'>
</div>
</div>

</div></div>";
}
}

echo "</div></div></div> <hr style='height:1px;' /> ";


/////////////////////////////////////////////////////////////////////////////////Contract Nav and Info!
if ($mid == '') {}else{
echo "<div class='row' id='contracts'>
<div class='col-sm-4 col-md-2'>
<div class='mailbox_nav'>
<div class='sepH_b'>
<a href='create_contract.php?id=", $id, "&sid=", $sid, "&mid=", $mid, "' class='btn btn-default btn-sm' style='width:100%;'>Create A Contract</a>
</div>
<ul class='nav nav-pills nav-stacked' style=' height:";
if ($cid == '') {echo "150px;";}else{echo "750px;";}
echo " overflow: auto;'>";

if ($mid == '') { echo "";}else{
if(!countmeterscontracts($mid)){
echo "No Contracts for this Meter";
}else {
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function activec($link) {
$cid = $_GET['cid'];
if($link==$cid) { echo " class='active'";}
}

foreach ($contracts as $v1) {

if ($mid == $v1['meter_id']) {
if ($v1['hidden'] == '') {
echo "<li", activec($v1['id']), "><a href='sites.php?id=", $id, "&sid=", $sid, "&mid=", $mid, "&cid=", $v1['id'], "'>";
$result = substr($v1['timestamp'], 0, 10);
echo $result;
echo "</a></li>";
}

}
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
}
echo "</ul></div></div>";
echo "<div class='col-sm-8 col-md-10'>";

if ($cid == '') {
echo "
<table id='mailbox_table' class='table toggle-square footable-loaded footable default' 
data-filter='#mailbox_search' data-page-size='20' data-provides='rowlink'>
<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
<p>Please click a Contract to view its details (Use the navigation menu to your left)</p></div>
</table>";
}
else{
echo "<div class='panel panel-default' style=' height:865px;'>
<div class='panel-heading' style='padding:0px!important;'>

<div style='width:100%; height:100%;'>
<div class='progress-bar progress-bar-info' style='width:";
progressbar_contracts ($cid);
echo"%'><h4 class='panel-title pull-left' style='padding-left:10px; width:700px; text-align:left'>Contract Details - ";
progressbar_contracts ($cid);
echo "% Complete</h4></div></div>
</div>

<div class='panel-body'>
<div class='form-horizontal user_form'>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>New Contract Agreed:</label>
<div class='col-sm-1'><center>";
echo "</center></div><div class='col-sm-8'>
<input type='text' id='datepickernca' class='form-control' name='nca' value='", $contractdetails['nca'], "'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>New Contract Start:</label>
<div class='col-sm-1'><center>";
echo "</center></div><div class='col-sm-8'>
<input type='text' id='datepickerncs' class='form-control' name='ncs' value='", $contractdetails['ncs'], "'/>
</div></div>
 
<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>LOA:</label>
<div class='col-sm-1'><center>
<input type='checkbox' id='loa' name='loa'";
if ($contractdetails['loa'] == 'yes') { echo "checked='checked'";}
echo "value='yes'></center></div><div class='col-sm-8'>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Bill:</label>
<div class='col-sm-1'><center>
<input type='checkbox' id='bill' name='bill' ";
if ($contractdetails['bill'] == 'yes') { echo "checked='checked'";}
echo "value='yes'></center></div><div class='col-sm-8'>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>CED Confirmed:</label>
<div class='col-sm-1'><center>
<input type='checkbox' id='cedconfirmedv' name='cedconfirmedv' ";
if ($contractdetails['cedconfirmedv'] == 'yes') { echo "checked='checked'";}
echo "value='yes'></center></div><div class='col-sm-8'>
<input type='text' id='datepickercedconfirmed' class='form-control' name='cedconfirmed' value='", $contractdetails['cedconfirmed'], "'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>EAC Confirmed:</label>
<div class='col-sm-1'><center>
<input type='checkbox' id='eacconfirmedv' name='eacconfirmedv' ";
if ($contractdetails['eacconfirmedv'] == 'yes') { echo "checked='checked'";}
echo "value='yes'></center></div><div class='col-sm-8'>
<input type='text' id='datepickereacconfirmed' class='form-control' name='eacconfirmed' value='", $contractdetails['eacconfirmed'], "'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Supplier:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='supplier' value='", $contractdetails['supplier'], "'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Termination Lodged:</label>
<div class='col-sm-1'><center>
<input type='checkbox' id='terminationlodgedv' name='terminationlodgedv' ";
if ($contractdetails['terminationlodgedv'] == 'yes') { echo "checked='checked'";}
echo "value='yes'></center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='terminationlodged' value='", $contractdetails['terminationlodged'], "'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Termination Accepted:</label>
<div class='col-sm-1'><center>
<input type='checkbox' id='terminationaccepptedv' name='terminationaccepptedv' ";
if ($contractdetails['terminationaccepptedv'] == 'yes') { echo "checked='checked'";}
echo "value='yes'></center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='terminationacceppted' value='", $contractdetails['terminationacceppted'], "'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Termination Window Open:</label>
<div class='col-sm-1'><center>
<input type='checkbox' id='terminationwindowopenv' name='terminationwindowopenv' ";
if ($contractdetails['terminationwindowopenv'] == 'yes') { echo "checked='checked'";}
echo "value='yes'></center></div><div class='col-sm-8'>
<input type='text' id='datepickeropen' class='form-control' name='terminationwindowopen' value='", $contractdetails['terminationwindowopen'], "'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Termination Window Closes:</label>
<div class='col-sm-1'><center>
<input type='checkbox' id='terminationwindowclosesv' name='terminationwindowclosesv' ";
if ($contractdetails['terminationwindowclosesv'] == 'yes') { echo "checked='checked'";}
echo "value='yes'></center></div><div class='col-sm-8'>
<input type='text' id='datepickerclose' class='form-control' name='terminationwindowcloses' value='", $contractdetails['terminationwindowcloses'], "'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Rate 1:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='rate1' value='", $contractdetails['rate1'], "'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Rate 2:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='rate2' value='", $contractdetails['rate2'], "'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Rate 3:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='rate3' value='", $contractdetails['rate3'], "'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Rate 4:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='rate4' value='", $contractdetails['rate4'], "'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Rate 5:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='rate5' value='", $contractdetails['rate5'], "'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>KVA:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='kva' value='", $contractdetails['kva'], "'/>
</div></div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-3 control-label'>Annual Spend:</label>
<div class='col-sm-1'><center>
</center></div><div class='col-sm-8'>
<input type='text' class='form-control' name='annualspend' value='", $contractdetails['annualspend'], "'/>
</div></div>

</div>
</div>
</div>";
}

echo "</div></div><hr style='height:1px;' /> ";
}
/////////////////////////////////////////////////////////////End of form and overall progress bar
if ($cid == '') {}else{
echo "<div class='panel panel-default' style=' height:0px;'>
<div class='panel-heading' style='padding:0px!important;'>
<div style='width:100%; height:100%;'>
<div class='progress-bar progress-bar-info' style='width:";
progressbar_overall($sid, $mid, $cid);
echo"%'><h4 class='panel-title pull-left' style='padding-left:10px; width:700px; text-align:left'>";
progressbar_overall($sid, $mid, $cid);
echo "% Complete</h4></div></div></div></div>";
}

echo "<br/><br/><br/>
<button style='float:right;' class='btn btn-primary'>Update Information</button>
</form>
";
}
}
/////////////////////////////////////////////////////////////Footer
echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>