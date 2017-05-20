<?php
$page = "Benefits";
require("fe/config.php");
include_once("fe/header.php");
headerimage("gasnobs.jpg");

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
	<li><a href='monitoringandreduction.php'>Monitoring &amp; Reduction</a></li>
	<li class='active'><a href='carbonreductioninitiatives.php'>Contract End Date Consolidation</a></li>
	<li><a href='largeuser.php'>Large User</a></li>
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>Working closely with selected partners we can also implement a strategy to consolidate multiple 
contract end dates to one single end date for all contracts that you have.</b></p>
<p>This is hugely popular with our larger multi-site operators as it allows for a one time review of all sites 
rather than multiple reviews and also means that you go to market with a larger consumption increasing your 
buying power.</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>