<?php
$type = "admin";
$title = "Reports";
$step = $_GET['step'];
$reporttype= $_GET['name'];
$reportformat= $_GET['format'];
require_once("../models/config.php");
require_once("../assets/scripts/progressbar_sites.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
if ($step == '') {header('Location: reports.php?step=1');}

if(!empty($_POST)){
//step1
	if ($step == '1') {
	$report = trim($_POST["report"]);
	header('Location: reports.php?step=2&name='. $report);
	}
//step2
	if ($step == '2') {
	$report1 = trim($_POST["report1"]);
	$format = trim($_POST["format"]);
	
	header('Location: reports.php?step=3&name='.$report1.'&format='.$format);
	}
	
//step3
	if ($step == '3') {
	$report1 = trim($_POST["report1"]);
	$format1 = trim($_POST["format1"]);

	}
}

//get page sidebar, navigation bar
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

if ($step == '1') {echo"
	<li role='tab' class='first current' aria-disabled='false' aria-selected='true'><a id='steps-uid-1-t-0'  aria-controls='steps-uid-1-p-0'>
	<span class='current-info audible'>current step: </span><span class='number'>1</span> Report</a></li>

	<li role='tab' class='disabled' aria-disabled='true'><a id='steps-uid-1-t-1'  aria-controls='steps-uid-1-p-1'>
	<span class='number'>2</span> Format</a></li>

	<li role='tab' class='disabled last' aria-disabled='true'><a id='steps-uid-1-t-2'  aria-controls='steps-uid-1-p-2'>
	<span class='number'>3</span> Generate</a></li> ";}
elseif ($step == '2') {echo"
	<li role='tab' class='first disabled' aria-disabled='true' aria-selected='true'><a id='steps-uid-1-t-0'  aria-controls='steps-uid-1-p-0'>
	<span class='current-info audible'>current step: </span><span class='number'>1</span> Report</a></li>

	<li role='tab' class='current' aria-disabled='false'><a id='steps-uid-1-t-1'  aria-controls='steps-uid-1-p-1'>
	<span class='number'>2</span> Format</a></li>

	<li role='tab' class='disabled last' aria-disabled='true'><a id='steps-uid-1-t-2'  aria-controls='steps-uid-1-p-2'>
	<span class='number'>3</span> Generate</a></li> ";}
elseif ($step == '3') {echo"
	<li role='tab' class='first disabled' aria-disabled='true' aria-selected='true'><a id='steps-uid-1-t-0'  aria-controls='steps-uid-1-p-0'>
	<span class='current-info audible'>current step: </span><span class='number'>1</span> Report</a></li>

	<li role='tab' class='disabled' aria-disabled='true'><a id='steps-uid-1-t-1'  aria-controls='steps-uid-1-p-1'>
	<span class='number'>2</span> Format</a></li>

	<li role='tab' class='current last' aria-disabled='false'><a id='steps-uid-1-t-2'  aria-controls='steps-uid-1-p-2'>
	<span class='number'>3</span> Generate</a></li> ";}	
	
//closing head divs and containers	
echo"</ul></div>";

//step 1
if ($step == '1') {echo"<div class='content clearfix' style='height: 236px;'><h4 id='steps-uid-1-h-0' tabindex='-1' class='title current'>Report</h4>
<fieldset id='steps-uid-1-p-0' role='tabpanel' aria-labelledby='steps-uid-1-h-0' class='body current' aria-hidden='false' style='display: block;'>
<div class='row'><div class='col-sm-3'>
	<div class='step_info'><h4>Report</h4>
	<p>Please select the report you want to generate. <br/><br/> The next step will concist of you declaring the format you want the report to be generated in.</p></div>
</div>
<div class='col-sm-9'>
<div class='form_sep'>
<div class='form-group'>	
	<select id='report' name='report' class='form-control'>

		<option value='cbt' >Call Backs Today</option>
		<option value='c6' >Clients (6 month)</option>
		<option value='p6' >Prospects (6 month)</option>
		<option value='ac' >All Clients</option>
		<option value='ap' >All Prospects</option>
		<option value='cedr' >CED Report</option>
		<option value='cs' >Current Supplier</option>
		<option value='c' >Commission</option>
		
	</select>
</div>
</div>

</div>
</div>
</fieldset>";}

//step 2
elseif ($step == '2') {echo"<div class='content clearfix' style='height: 236px;'><h4 id='steps-uid-1-h-0' tabindex='-1' class='title current'>Format</h4>
<fieldset id='steps-uid-1-p-0' role='tabpanel' aria-labelledby='steps-uid-1-h-0' class='body current' aria-hidden='false' style='display: block;'>
<div class='row'><div class='col-sm-3'>
	<div class='step_info'><h4>Format</h4>
	<p>Please declare the format you want the report to be generated in.<br/><br/> The next step will generate your chosen report in the format you want.</p></div>
</div>
	<input type='hidden' name='report1' value='", $reporttype, "'/>
<div class='col-sm-9'>
<div class='form_sep'>
<div class='form-group'>	
<select id='format' name='format' class='form-control'>

		<option value='table' >Table</option>
		
	</select>
</div>
</div>

</div>
</div>
</fieldset>";}

//step 3
elseif ($step == '3') {echo"<div class='content clearfix' style='height: 110%;'><div class='content clearfix'><h4 id='steps-uid-1-h-0' tabindex='-1' class='title current'></h4>
<fieldset id='steps-uid-1-p-0' role='tabpanel' aria-labelledby='steps-uid-1-h-0' class='body current' aria-hidden='false' style='display: block;'>
<div class='row'><input type='hidden' name='format1' value='", $reportformat, "'/>

<div name='reportcontent'>
";	

//report | All Clients
if ($reporttype == 'ac') {
$reportac = reportac();

echo "<h1 class='heading_a' style='margin-left:15px; margin-right:15px;'>All Clients</h1>"; 

foreach ($reportac as $v1) {
echo "
<div class='panel panel-default' style=' height:350px; margin-left:15px; margin-right:15px;'>
<div class='panel-heading' style='padding:0px!important;'>
<div class='progress-bar progress-bar-info' style='width:";
progressbar_user($v1['id']);
echo"%'><h4 class='panel-title pull-left' style='padding-left:10px; width:700px; text-align:left'>User Details - ";

progressbar_user($v1['id']);
echo "% Complete</h4></div>
</div>
<center>
<table class='table table-condensed' style='margin-left:15px;'>
<tbody>
<tr><td>Id:</td><td>".$v1['id']."</td></tr>
<tr><td>First Name:</td><td>".$v1['first_name']."</td></tr>
<tr><td>Second Name:</td><td>".$v1['second_name']."</td></tr>
<tr><td>Email:</td><td>".$v1['email']."</td></tr>
<tr><td>Phone Number:</td><td>".$v1['phonenumber']."</td></tr>
<tr><td>Company:</td><td>".$v1['company']."</td></tr>

<tr><td>Street:</td><td>".$v1['street']."</td></tr>
<tr><td>Town:</td><td>".$v1['town']."</td></tr>
<tr><td>City:</td><td>".$v1['city']."</td></tr>
<tr><td>Postcode:</td><td>".$v1['postcode']."</td></tr>
</tbody>
</table></center></div>

";
}
}















echo "</div></div>
</div>

</div>
</div>
</fieldset>";}

 

//pagination and closing of divs/containers
echo"</div>

<div class='actions clearfix'>
<ul role='menu' aria-label='Pagination' style='list-style:none;' >";

if ($step == '1') {echo"
<li class='prev_step disabled' aria-disabled='true'><a href='${websiteUrl}admin/reports.php?step=1' class='btn btn-link' role='menuitem'>Previous</a></li>
<button class='next_step btn btn-default' class='btn btn-primary'>Next</button>";}
elseif ($step == '2') {echo"
<li class='prev_step' aria-hidden='false' aria-disabled='false'><a href='${websiteUrl}admin/reports.php?step=1' class='btn btn-default' role='menuitem'>Previous</a></li>
<button class='next_step btn btn-default' class='btn btn-primary'>Next</button>";}
elseif ($step == '3') {echo"
<br/><li class='prev_step' aria-hidden='false' aria-disabled='false'><a href='${websiteUrl}admin/reports.php?step=2&name=", $reporttype, "' class='btn btn-default' role='menuitem'>Previous</a></li>";}

echo "</ul></div></form>
</div>
</div>
</div>
</div>
</section>";

echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>