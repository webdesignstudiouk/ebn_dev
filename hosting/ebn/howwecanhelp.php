<?php
$page = "Rollover And Termination";
require("fe/config.php");
include_once("fe/header.php");
headerimage("gas.jpg");

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
	<li class='active'><a href='howwecanhelp.php'>How we can help</a></li>
	<li><a href='whatdoyougetoutofit.php'>Benefits</a></li>
	<li><a href='joinustoday.php'>Register</a></li>
	
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>Your allocated account manager will monitor and be alerted to each trigger point in your 
contract term like an unpaid employee he will be in the background ensuring things go smoothly and that you 
receive no unpleasant surprises.</b></p>
<p>Many, many times we have heard 'but I didn’t receive the letter from my supplier', this is no defence when you 
have missed the deadline and every supplier has different rules on when and how to terminate and when new 
supply contracts can be agreed.</p>
<p>At The Energy Buyers Network, this is what we do on behalf of our clients, you don’t have to worry about missing 
dates, termination or rollover as we have it all in hand and your account manager will keep you updated at all 
times.</p>
<p>Contact Us for a friendly chat and we’ll explain further how you can benefit from registering like so many other 
energy cost conscious businesses up and down the country.</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>