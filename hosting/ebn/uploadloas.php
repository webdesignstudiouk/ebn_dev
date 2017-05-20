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
	<li><a href='loa.php'>introduction</a></li>
	<li><a href='loa.docx'>Download the LOA</a></li>
	<li class='active'><a href='uploadloas.php'>Upload the completed LOA</a></li>
	<li><a href='uploadbills.php'>Upload Bills</a></li>
</ul>
</div>

<div class='col-md-4'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; overflow-x:hidden; overflow-y:auto;' class='scrollbar' id='style-2'> <div class='force-overflow'>
<iframe src='uploads/index.php' width='100%' height='400px;' style='overflow-x:hidden; overflow-y:hidden;'  marginheight='0' frameborder='0'
	onLoad='autoResize('iframe1');'></iframe>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>