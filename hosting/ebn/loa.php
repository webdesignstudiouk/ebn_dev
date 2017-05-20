<?php
$page = "LOA";
require("fe/config.php");
include_once("fe/header.php");
headerimage("pen.jpg");

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
	<li class='active'><a href='loa.php'>Introduction</a></li>
	<li><a href='loa.docx'>Download the LOA</a></li>
	<li><a href='#' data-toggle='modal' data-target='#modalLoa'>Upload LOA</a></li>
	<li><a href='#' data-toggle='modal' data-target='#modalLoa'>Upload Bills</a></li>
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<p class='bold'><b>The LOA or by its correct term, 'Letter of Authorisation' is simply your permission for the Energy Buyers Network to 
contact your supplier for your current contract details, without it your supplier will not release the details that we 
require and it can be withdrawn by you at any time.</b></p>
<p>Please download the 'LOA' template, from the download function on the tabs to the left, insert your company name in the <b>3 
places highlighted</b>, print on to <b>your own letterhead</b>, sign, date etc. (Please note that you must be authorised to do so)</p>
<p>Once complete please upload the <b>signed 'LOA'</b> along with a copy of your <b>gas and or electricity bill (all pages)</b> using the upload 
tabs to the left alternatively you can email them to <a href='mailto:loa@energybuyersnetwork.com'>loa@energybuyersnetwork.com</a></p>
<p>Upon receipt your allocated account manager will contact your encumbent supplier to ensure that your bill reflects your contract 
and to request confirmation of your current contract end date and annual consumption.</p>
<p>Once we have received confirmation of your contract details we will be in touch with an action plan, Contact Us for more 
information on this process.</p>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>