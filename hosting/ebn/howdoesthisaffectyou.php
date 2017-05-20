<?php
$page = "Rollover And Termination";
require("fe/config.php");
include_once("fe/header.php");
headerimage("industrial.jpg");

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
	<li class='active'><a href='howdoesthisaffectyou.php'>Termination</a></li>
	<li><a href='howwecanhelp.php'>How we can help</a></li>
	<li><a href='whatdoyougetoutofit.php'>Benefits</a></li>
	<li><a href='joinustoday.php'>Register</a></li>
	
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>Termination, sounds very final doesn't it! It is simply a process whereby we advise your 
current supplier that you wish to terminate your contract at the expiry date of your current contract. It 
means that you are free to accept an offer from one of our other supply partners if a better offer is made.</b></p>
<p>Termination Periods differ with suppliers, each have their own rules with regard to termination periods for 
each type of contract, again we monitor such dates and act accordingly such as lodging the correct paperwork 
on your behalf and ensuring acceptance.</p>
<p>If you fail to Terminate in accordance with your suppliers Terms and Conditions then you could well be 
tied to them for another year even if there's a better deal out there for you, get in touch and we'll explain 
how we ensure your 'Termination Window' adherence.</p>
</div></div></div> 

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>