<?php
$page = "Rollover And Termination";
require("fe/config.php");
include_once("fe/header.php");
headerimage("keyboard1.jpg");

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
	<li><a href='whatdoyougetoutofit.php'>Benefits</a></li>
	<li class='active'><a href='joinustoday.php'>Register</a></li>
	
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<b><p class='bold'>Registration is Free of Charge, there are no future costs either and you are under no obligation 
to accept any contract from us we merely advise, monitor and work across the whole market in order to achieve 
the best deal in the market at renewal.</b></p>
<p>Register or use the contact page above and we'll gladly explain why you should join thousands of 
like-minded businesses in the fight against spiralling energy costs.</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>