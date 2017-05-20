<?php
$page = "Home";
require("fe/config.php");
include_once("fe/header.php");
headerimage("keyboard.jpg");

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
	<li><a href='energybuyersnetwork.php'>Energy Buyers Network</a></li>
	<li class='active'><a href='join.php'>Register</a></li>
	</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>Upon registering you will be asked to supply recent copies of your electricity and 
gas bills and supply us with a Letter of Authority which simply allows us to approach your current 
supplier for confirmation of your annual consumption and contract end date and to approach the market 
on your behalf.</b></p>
<p>By registering with the Energy Buyers Network along with other like-minded businesses it is possible 
to access specialist pricing usually only available to large corporations and as we grow all members 
will reap the benefits of our bulk buying power irrespective of size or energy consumption.</p>
<p>A recent white paper predicts staggering energy price rises of up to 81% by 2021.</p>
<p>This coupled with the financial pressure of The Climate Change Levy, Carbon Reduction Commitment and 
Renewable Obligation mean that The Energy Buyers Network will be best placed to tackle energy costs now 
and in the future.</p>
<p>Register and an account manager will contact you to explain further the benefits of being part of 
the fastest growing Energy Buying groups in the UK, remember 'Together we're Stronger</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>