<?php
$page = "Contact Us";
require("fe/config.php");
include_once("fe/header.php");

echo"

<section class='header-image'>
	<div class='container'>
	 <iframe width='100%' height='377px' frameborder='0' style='border:0'
src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2290.1083523137763!2d-1.619988999999983!3d54.97119900000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487e70b54ac34eaf%3A0xb41014b699f0f84f!2sEnergy+Buyers+Network!5e0!3m2!1sen!2suk!4v1426252108410'></iframe>


	</div>
</section>

<div class='container'>

<div class='row'>
<div class='col-md-5 col-md-offset-3'>
<h1>".$page."</h1>
</div>
</div>

<div class='row'>
<div class='col-md-7'>
<div class='tab-content'>

<div class='tab-pane active'>
<div style='height: 300px; width:100%; overflow-x:hidden; overflow-y:auto;' class='scrollbar'  id='style-2'> 
<div class='force-overflow'>
	
	
	<br>
	<p><b>Energy Buyers Network<br/>
	Ground Floor<br/>
	5 Charlotte Square<br/>
	Newcastle Upon Tyne<br/>
	NE1 4XF

	</b></p>
	<p>Tel:0191 261 0760<br/></p>
	Email:<a href='mailto:info@energybuyersnetwork.com'>info@energybuyersnetwork.com</a>
	<br>
	



	<form action='scripts/sendmail.php' method='post'>
	<div class='form-group'>
	<input type='text' class='form-control' name='fullname' placeholder='Enter Full Name'>
	</div>
	<div class='form-group'>
	<input type='email' class='form-control' name='email' placeholder='Enter Email'>
	</div>
	<div class='form-group'>
	<input type='text' class='form-control' name='phonenumber' placeholder='Enter Phone Number'>
	</div>
	<div class='form-group'>
	<input type='text' class='form-control' name='company' placeholder='Enter Company Name'>
	</div>
	<div class='form-group'>
	<label class='col-sm-2 control-label'>Message</label>
	<textarea class='form-control' name='message' rows='3'></textarea>
	</div>
	<button type='submit' class='btn btn-default' style='float:right; width:100px;'>Submit</button>
	</form>
</div></div></div>

</div></div>";

echo $loginform;
echo $sidebar;


include_once("fe/footer.php");



?>