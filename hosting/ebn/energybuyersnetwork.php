<?php
$page = "Home";
require("fe/config.php");
include_once("fe/header.php");
headerimage("powerlines.jpg");

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
	<li><a href='home.php' >Who We Are</a></li>
	<li><a href='whatwedo.php'>What We Do</a></li>
	<li class='active'><a href='energybuyersnetwork.php'>Energy Buyers Network</a></li>
	<li><a href='join.php'>Register</a></li>
	</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>As an energy buying group we regularly make substantial savings up to 25% and frequently as 
much as 40% of annual energy costs, all going directly to your bottom line.</b></p>
<p>In today's climate of ever increasing energy costs it is much more difficult to find a cheaper tariff but it 
is best practice to ensure that you secure the best tariff in the market at your renewal.</p>
<p>Your allocated account manager will monitor your contract and contact you at the critical stages such as 
the opening of your Termination Window and handle everything for you.</p>
<p>It is essential that we understand your current consumption and meter profile type. This enables us to 
verify that you are currently on the correct meter profile and enjoying the best possible tariff.</p>
<p>Register to find out more on how we can assist you in controlling your energy costs.</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>