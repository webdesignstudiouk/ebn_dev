<?php
$page = "Partners";
require("fe/config.php");
include_once("fe/header.php");
headerimage("partnerlogos.jpg");

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
	<li><a href='partners.php'>In Brief</a></li>
	<li class='active'><a href='ourpatners.php'>Our Partners</a></li>
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>De-regulation in the early 90's opened up competition in the commercial energy market.</b></p>

<p>The dominant leaders in the energy market, known as the 'Big 6', are British Gas, EDF Energy, E.ON, 
Scottish and Southern Energy, npower and Scottish Power, all of whom we have strong long standing 
relationships with.</p>

<p>However there are many other energy suppliers that have entered the market over the over the past two 
decades giving you a wider choice of tariff and contract type, the trick is to know where to find the 
best deal for your consumption requirements and type of business.</p>

<p>The Energy Buyers Network work with over 25 commercial energy supply partners in the UK, some are not 
as widely known as the big 6 and may be more specialised but this gives us full market access to a 
contract to suit your business.</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>