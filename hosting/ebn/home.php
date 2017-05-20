<?php
$page = "Home";
require("fe/config.php");
include_once("fe/header.php");
headerimage("windturbines.jpg");

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
	<li class='active'><a href='home.php' >Who We Are</a></li>
	<li><a href='whatwedo.php'>What We Do</a></li>
	<li><a href='energybuyersnetwork.php'>Energy Buyers Network</a></li>
	<li><a href='join.php'>Register</a></li>
	</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'>
<b>
The Energy Buyers Network is a specialist energy procurement consultancy which offers a platform for individual businesses to access energy through “Combined Consumption Purchasing”, offering fixed and flexible contracts for up to 5 years and a suite of energy saving products and validation services. 
</b>
</p>

<p>We are not suppliers of energy and are independent with no affiliation to any one supplier, we simply combine consumption to access rates on the wholesale energy market that are usually only available to very large consumers of electricity and gas. </p>

<p>Clients retain their own supply contract with a specific supplier and pay them directly for their consumption for the contract term of their choice, we simply facilitate the process for the benefit of all involved in the “CCP”. </p>

<p>Having long standing relationships with the “Big 6” and over 20 specialist suppliers we regularly save our clients up to 40% against current energy costs or projected renewal cost. </p>

<p>We’re only human and love to talk and spread the word about how we’re revolutionising energy procurement in the UK and would welcome any discussion on how we could have a positive impact on your bottom line so get in touch and we look forward to hearing from you soon. </p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;
 

include_once("fe/footer.php");



?>