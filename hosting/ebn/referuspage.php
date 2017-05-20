<?php
$page = "Refer Us";
require("fe/config.php");
include_once("fe/header.php");
headerimage("oil2.jpg");

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
	<li class='active'><a href='referuspage.php'>Referals</a></li>
	<li><a href='howtoreferus.php'>How To Promote EBN</a></li>
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>Although we promote the Energy Buyers Network through a host of different media, we ask our 
members to actively promote our services to their own clients, members and colleagues aiding us to grow our 
membership for the benefit of all. </b></p>
<p>The more members we have increases our ability to negotiate with the UK 
energy suppliers ensuring our membership get the 'best deal' and not a 'raw deal' when it comes to energy 
costs. So please display our logo in your stationary, digital communications and link us to your website as 
'Together we're Stronger'</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>