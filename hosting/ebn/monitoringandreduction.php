<?php
$page = "Benefits";
require("fe/config.php");
include_once("fe/header.php");
headerimage("pylon1.jpg");

echo"
<div class='container'>

<div class='row'>
<div class='col-md-5 col-md-offset-3'>
<h1>".$page."</h1>
</div>
</div>

<div class='row'>
<div class='col-md-3' >
<ul class='nav nav-pills nav-stacked'>
	<li><a href='benefits.php'>EBN Benefits</a></li>
	<li><a href='billvalidation.php'>Bill Validation</a></li>
	<li class='active'><a href='monitoringandreduction.php'>Monitoring &amp; Reduction</a></li>
	<li><a href='carbonreductioninitiatives.php'>Contract End Date Consolidation</a></li>
	<li><a href='largeuser.php'>Large User</a></li>
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>Working with carefully selected partners within the industry we have a range of monitoring 
solutions to enable you to keep an accurate record of your consumption, when it spikes, when it drops and 
the identification of wastage.</b></p>
<p>Site surveys are undertaken to identify ways of reducing your consumption whether it be a simple socket 
timer or a full overhaul of operating procedures, all of these count towards reducing your total energy 
cost.</p>
<p>Speak to an account manager for more information.</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>