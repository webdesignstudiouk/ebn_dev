<?php
$page = "Together We're Stronger";
require("fe/config.php");
include_once("fe/header.php");
headerimage("oil.jpg");

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
	<li><a href='togetherwerestronger.php'>Take a Look</a></li>
	<li><a href='whatweoffer.php'>What We Offer</a></li>
	<li class='active'><a href='suppliers.php'>Suppliers</a></li>
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>The Energy Buyers Network are NOT energy suppliers and we do not sign supply contracts 
on your behalf we simply use our combined purchasing power to offer a whole market review of unit rates at your 
renewal, present the findings then you are free to choose your supplier and Tariff.</b></p>
<p>We are independent, we are not tied to any of the UK energy suppliers however we have strong relationships 
with over 20 major UK suppliers for commercial gas and electricity.</p>
<p>You can view our supplier partners by clicking the Partners Tab on the navigation bar above.</p>
<p>Not all suppliers will suit your requirements its 'horses for courses' but we will identify the suppliers suited 
to your need, combine your consumption with others and put the basket out to tender.</p>
<p>You still receive your own contract with the supplier and pay your bill as you would normally, you will 
not be part of a collective agreement.</p>
<p>We would be happy to discuss the process further with you.</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>