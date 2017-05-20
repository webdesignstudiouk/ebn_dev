<?php
$page = "Partners";
require("fe/config.php");
include_once("fe/header.php");
headerimage("shakinghands.jpg");

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
	<li class='active'><a href='partners.php'>In Brief</a></li>
	<li class=''><a href='ourpatners.php'>Our Partners</a></li>
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>De-regulation in the early 90's opened up competition in the UK’s commercial 
energy market.</b></p>

<p>Today there are many commercial gas and electricity suppliers in the market place with hundreds 
of contract and tariff types being available to you.</p>

<p>With strong relationships across all commercial energy suppliers you can be sure of securing the 
optimum tariff for your business when you register with the Energy Buyers Network.</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>