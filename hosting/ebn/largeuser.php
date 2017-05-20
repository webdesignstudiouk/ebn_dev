<?php
$page = "Benefits";
require("fe/config.php");
include_once("fe/header.php");
headerimage("accounting.jpg");

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
	<li><a href='carbonreductioninitiatives.php'>Contract End Date Consolidation</a></li>
	<li class='active'><a href='largeuser.php'>Large User</a></li>
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>Are you a large user of Gas or Power? If so we have a dedicated corporate team that work 
only on Half Hourly Power and Corporate Level Gas tendering.</b></p>
<p>This type of tender is different to SME level negotiation as it is priced directly from the 'Live Curve' 
energy market and is usually only available on the day it is tendered.</p>
<p>We have many specialist supply partners for this type of contract and will find the supplier and tariff to 
best suit your requirements.</p>
<p>Contact Us and ask to speak to our Corporate Team to discuss your needs, theres no obligation and we will 
happily discuss the process with you.</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>