<?php
require_once('models/config.php');

	echo"<div class='col-xs-12 col-sm-6 col-md-3' style='margin-bottom:10px;'>
	<div id='login'>";
	
	if(isUserLoggedIn()) {
	echo "
	<a type='button' class='btn btn-default' href='members/user_settings.php?id=1'>Members Area</a>
	<a type='button' class='btn btn-default' href='members/energy_prices.php'>Energy Graphs</a>
	<a type='button' class='btn btn-default' href='logout.php'>Logout</a>
	";
	}else{
	echo "<form action='scripts/login.php' id='login_form' method='post'>
	<div class='form-group'>
	<input type='text' name='username' class='form-control' placeholder='Username'>
	</div>
	<div class='form-group'>
	<input type='password' name='password' class='form-control' placeholder='Password'>
	</div>
	<input type='submit' class='btn btn-default' value='Sign In'>
	<a type='button' class='btn btn-default' href='home.php?formid=modalRegister'>Register</a>
	<a type='button' class='btn btn-default' href='home.php?formid=modalFP'>Forgot Password</a>
	</form>";
	}
	
	echo "</div> 
	</div>";

?>