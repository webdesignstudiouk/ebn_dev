<?php
$page = "Rollover And Termination";
require("fe/config.php");
include_once("fe/header.php");
headerimage("people2.jpg");

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
	
	<li class='active'><a href='rolloverandtermination.php'>Rollover</a></li>
	<li><a href='howdoesthisaffectyou.php'>Termination</a></li>
	<li><a href='howwecanhelp.php'>How we can help</a></li>
	<li><a href='whatdoyougetoutofit.php'>Benefits</a></li>
	<li><a href='joinustoday.php'>Register</a></li>
	
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>If you fail to have a new supply contract in place when your current contract ends then 
your supplier will automatically 'Roll' you over onto a new one year contract. Your new unit rates which 
are known as Out of Contract Rates and can be as much as 50% higher than the market rate at the time.</b></p>
<p>Working with us will give you the peace of mind that however busy YOU are running your business WE will not 
miss this and allow you to get into this situation as our monitoring and adherence procedures and systems 
will not allow it as warnings are flagged from as far out as 6 months from your contract end date.</p>
<p>The warnings are flagged to your dedicated account manager on a daily basis so you can be rest assured of never 
falling foul of the Rollover Trap.</p>
<p>Let us explain in person, contact us to arrange a visit or call from an industry professional.</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>