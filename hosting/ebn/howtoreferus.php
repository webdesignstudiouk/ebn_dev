<?php
$page = "Refer Us";
require("fe/config.php");
include_once("fe/header.php");
headerimage("oil3.jpg");

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
	<li><a href='referuspage.php'>Referals</a></li>
	<li class='active'><a href='howtoreferus.php'>How To Promote EBN</a></li>
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>Below are two different ways to link the Energy Buyers Network logo to your own website, below is a slice of code 
you can copy and paste into your website.</b></p>
<p><center>&lt;a href='http://www.energybuyersnetwork.com'/&gt; &lt;img src='http://tinyurl.com/ck7z9dk' 
width='300px' height='70px'/ &gt;  &lt;/a&gt;</center></p>
<p>Alternatively click the download button to save the image, by simply adding it to your website or your email you are helping us 
promote our services.</p>
<center><a class='btn btn-primary' href='images/logo.jpg'>Download</a></center>

</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>