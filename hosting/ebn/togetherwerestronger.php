<?php
$page = "Together We're Stronger";
require("fe/config.php");
include_once("fe/header.php");
headerimage("people.jpg");

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
	<li class='active'><a href='togetherwerestronger.php'>Take a Look</a></li>
	<li><a href='whatweoffer.php'>What We Offer</a></li>
	<li><a href='suppliers.php'>Suppliers</a></li>
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>More and more businesses are turning to The Energy Buyers Network, taking advantage of 
our preferential rates due to our expertise in energy procurement and our combined purchasing power.</b></p>
<p>Apart from the widely known Big 6 suppliers we have supply relationships with a host of specialist 
suppliers, in fact over 20 and we can access the best supplier, contract type and rate to suit your 
individual needs.</p>
<p>Why not Contact Us so that we can explain the benefits of our services and how as a group we can limit 
the future impact of energy price increases for all.</p>
<p>It takes but a few minutes to register your interest and that few minutes could have a direct, 
positive impact to your bottom line.</p>
<p>We look forward to speaking to you.</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>