<?php
require_once("models/config.php");

function headerimage($image){
echo"<section class='header-image'>
	<div class='container'>
	  <img src='images/".$image."' width='100%;'>
	</div>
</section>";
}


$sidebar= "
<div class='col-xs-12 col-sm-6 col-md-2'>
			<a type='button' class='btn btn-side' href='home.php?formid=modalLargeUser'>Large User?</a>
			<a type='button' class='btn btn-side' href='home.php?formid=modalEnergy'>Energy Prices</a>
			<a type='button' class='btn btn-side' href='http://webdesignstudiouk.com/hosting/ebn2/login.php'>Partner Login</a> 
</div> 

</div>"; 
 
$loginform = "
<div class='col-xs-12 col-sm-6 col-md-3' style='margin-bottom:10px;'>
			<div id='login'>
				<form action='http://webdesignstudiouk.com/hosting/ebn2/login.php' id='login_form' method='post'>
				<div class='form-group'>
				<input type='text' name='username' class='form-control' placeholder='Username'>
				</div>
				<div class='form-group'>
				<input type='password' name='password' class='form-control' placeholder='Password'>
				</div>
				<input type='submit' class='btn btn-default' value='Sign In'>
				<a type='button' class='btn btn-default' href='home.php?formid=modalRegister'>Register</a>
				<a type='button' class='btn btn-default' href='home.php?formid=modalFP'>Forgot Password</a>
				</form>
			</div> 
	</div>";
	


?>