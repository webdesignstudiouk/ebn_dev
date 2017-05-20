<?php
$page = "Together We're Stronger";
require("fe/config.php");
include_once("fe/header.php");
headerimage("woman1.jpg");

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
	<li><a href='suppliers.php'>Suppliers</a></li>
	<li class='active'><a href='referus.php'>Refer Us</a></li>
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>In addition to your support of the network we ask that to refer us to your colleagues, 
clients, suppliers and members.</b></p>
<p>The continued success of the network is dependent upon growth as with all businesses and with growth in 
numbers comes growth in amount of kwh (kilowatt hours) that we represent increasing our purchasing power 
for the future.</p>
<p>As well as verbally referring the network you can view other ways of promoting the network by clicking the 
Refer Us tab in the navigation bar above.</p>
<p>Remember, 'Together We're Stronger' give us a call !!</p>

</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>