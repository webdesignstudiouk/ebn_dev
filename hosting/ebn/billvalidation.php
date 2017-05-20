<?php
$page = "Benefits";
require("fe/config.php");
include_once("fe/header.php");
headerimage("wind1.jpg");

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
	<li class='active'><a href='billvalidation.php'>Bill Validation</a></li>
	<li><a href='monitoringandreduction.php'>Monitoring &amp; Reduction</a></li>
	<li><a href='carbonreductioninitiatives.php'>Contract End Date Consolidation</a></li>
	<li><a href='largeuser.php'>Large User</a></li>
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>Every year we see bills that are inaccurate, some by as much as 20%, you can take advantage of our 'Free' 
bill validation service once registered.</b></p>
<p>Your dedicated account manager will check over your bill and advise of any overcharge by your supplier, 
your account manager will also handle the refund or credit note request on your behalf if required.</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>