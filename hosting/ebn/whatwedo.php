<?php
$page = "Home";
require("fe/config.php");
include_once("fe/header.php");
headerimage("coolingchambers.jpg");

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
	<li class='active'><a href='whatwedo.php'>What We Do</a></li>
	<li><a href='energybuyersnetwork.php'>Energy Buyers Network</a></li>
	<li><a href='join.php'>Register</a></li>
	</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>We offer a fully managed service with an allocated account manager, however you are under no 
obligation to accept any offer from us and we DO NOT sign contracts on your behalf.</b></p>
<p>We monitor your contracts and ensure that you adhere to the stipulations of your contract such as Termination 
of your contract, freeing you to move to another supplier for a better deal and ensuring you do not fall into 
the rollover trap.</p>
<p>At the correct time your account manager will discuss with you your options for a new supply contract and 
collate whole market or specialist pricing for your particular meter profile and present the options to you, 
at that point we would make any recommendations but YOU make the final decision, after all it's 
YOUR business.</p>
<p>Contact Us or Register to find out more about our services and how we can assist you, we're human and 
prefer to speak so you will receive a call from an experienced account manager to answer any questions that 
you may have.</p>

</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>