<?php
$page = "Together We're Stronger";
require("fe/config.php");
include_once("fe/header.php");
headerimage("whatweoffer.jpg");

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
	<li class='active'><a href='whatweoffer.php'>What We Offer</a></li>
	<li><a href='suppliers.php'>Suppliers</a></li>
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>Our account managers are industry professionals and manage portfolios of meter types from a wide 
range of business from food manufacturers to art galleries and everything in between.</b></p>
<p>There is no qualifying criteria to be part of the UK's fastest growing Energy Buying Group all you need is 
to have an electricity meter, gas meter or both.</p>
<p>Our clients requirements range from one meter on one site to several hundred meters over multiple sites 
spread throughout the UK.</p>
<p>We do prefer to talk and build a comprehensive picture of your requirements before producing an action 
plan so why not Contact Us now for further insight into what we do.</p>
<p>You can call us directly or use the contact us page to drop us an email and we will gladly contact you for 
an informal chat.</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>