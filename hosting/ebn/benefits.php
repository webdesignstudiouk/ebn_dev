<?php
$page = "Benefits";
require("fe/config.php");
include_once("fe/header.php");
headerimage("industrial1.jpg");

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
	<li class='active'><a href='benefits.php'>EBN Benefits</a></li>
	<li><a href='billvalidation.php'>Bill Validation</a></li>
	<li><a href='monitoringandreduction.php'>Monitoring &amp; Reduction</a></li>
	<li><a href='carbonreductioninitiatives.php'>Contract End Date Consolidation</a></li>
	<li><a href='largeuser.php'>Large User</a></li>
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p> * A fully managed service with dedicated account manager <br><br>
	* Whole market contract negotiation handled by an industry professional <br><br>
	* A range of energy services available to you <br><br>
	* Access to pricing usually only available to large corporations <br><br>
	* No need for a broker <br><br>
	* Market reports and forecasts at your fingertips <br><br>
	* Contract monitoring and adherence <br><br>
	* Industry Insight and Pricing Alerts through our forum <br> <br>
	* Enjoy 'Strength in Numbers' and get the real deal not a raw deal <br><br>
	* Positive impact on your bottom line</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>