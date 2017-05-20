<?php
$page = "Rollover And Termination";
require("fe/config.php");
include_once("fe/header.php");
headerimage("people4.jpg");

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
	
	<li><a href='rolloverandtermination.php'>Rollover</a></li>
	<li><a href='howdoesthisaffectyou.php'>Termination</a></li>
	<li><a href='howwecanhelp.php'>How we can help</a></li>
	<li class='active'><a href='whatdoyougetoutofit.php'>Benefits</a></li>
	<li><a href='joinustoday.php'>Register</a></li>
	
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>
 
<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<b><p class='bold'>If you still havn't figured out the benefit of working with us here's a few reminders of what you 
get by just supporting the network with your consumption, remember you pay nothing !</b></p>
	* A fully managed service with dedicated account manager <br><br>
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