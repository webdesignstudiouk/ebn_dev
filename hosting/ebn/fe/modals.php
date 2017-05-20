<?php
//register form
echo "
<div class='modal fade ontop' id='modalRegister' tabindex='' role='dialog' 
aria-labelledby='modalRegister' aria-hidden='true' style='z-index:9999;'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header'>
<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
<h4 class='modal-title' id='myModalLabel'>Register</h4>
</div>
<div class='modal-body'>

<form action='scripts/register.php' class='form-horizontal' method='post'>
<p>Fields with (*) are required</p></br>
<input type='hidden' name='formid' value='register'>";

$strerrors = $_GET['errors'];
$strsuccesses = $_GET['successes'];
$errors = unserialize($strerrors);
$successes = unserialize($strsuccesses);
if (is_array($errors))
{
echo resultBlock($errors,$successes);		
}

echo "<div class='form-group'>
<label class='col-sm-3 control-label'>Username*:</label>
<div class='col-sm-9'>
<input type='text' class='form-control' data-validation='length' data-validation-length='min6'' name='user' value=''>
</div>
</div>

<div class='form-group'>
<label class='col-sm-3 control-label'>First Name*:</label>
<div class='col-sm-9'>
<input type='text' class='form-control' data-validation='length' data-validation-length='min1'' name='first_name' value=''>
</div>
</div>

<div class='form-group'>
<label class='col-sm-3 control-label'>Surname*:</label>
<div class='col-sm-9'>
<input type='text' class='form-control' data-validation='length' data-validation-length='min1'' name='second_name' value=''>
</div>
</div>

<input type='hidden' name='agent' id='agent' style='width:500px; margin-top:30px;' value='0'><br>

<div class='form-group'>
<label class='col-sm-3 control-label'>Phone Number*:</label>
<div class='col-sm-9'>
<input type='text' class='form-control' data-validation='length' data-validation-length='min11' name='phonenumber' value=''>
</div>
</div>

<div class='form-group'>
<label class='col-sm-3 control-label'>Mobile Number*:</label>
<div class='col-sm-9'>
<input type='text' class='form-control' data-validation='length' data-validation-length='min1'' name='mphonenumber' value=''>
</div>
</div>

<div class='form-group'>
<label class='col-sm-3 control-label'>Company*:</label>
<div class='col-sm-9'>
<input type='text' class='form-control' data-validation='length' data-validation-length='min1' name='company' value=''>
</div>
</div>

<div class='form-group'>
<label class='col-sm-3 control-label'>Street*:</label>
<div class='col-sm-9'>
<input type='text' class='form-control' data-validation='length' data-validation-length='min1' name='street' value=''>
</div>
</div>

<div class='form-group'>
<label class='col-sm-3 control-label'>Town*:</label>
<div class='col-sm-9'>
<input type='text' class='form-control' data-validation='length' data-validation-length='min1' name='town' value=''>
</div>
</div>

<div class='form-group'>
<label class='col-sm-3 control-label'>City*:</label>
<div class='col-sm-9'>
<input type='text' class='form-control' data-validation='length' data-validation-length='min1' name='city' value=''>
</div>
</div>

<div class='form-group'>
<label class='col-sm-3 control-label'>Postcode*:</label>
<div class='col-sm-9'>
<input type='text' class='form-control' data-validation='length' data-validation-length='min1' name='postcode' value=''>
</div>
</div>

<div class='form-group'>
<label class='col-sm-3 control-label'>Password*:</label>
<div class='col-sm-9'>
<input type='password' class='form-control' data-validation='length' data-validation-length='min1' name='password' id='password'>
</div>
</div>

<div class='form-group'>
<label class='col-sm-3 control-label'>Confirm Password*:</label>
<div class='col-sm-9'>
<input type='password' class='form-control' data-validation='length' data-validation-length='min1' name='cpassword'>
</div>
</div>

<div class='form-group'>
<label class='col-sm-3 control-label'>Email*:</label>
<div class='col-sm-9'>
<input type='text' class='form-control' data-validation='length email' data-validation-length='min1'' name='email' value=''>
</div>
</div>

<div class='form-group'>
<div class='col-sm-3'></div>
<div class='col-sm-9'>
</p><center><img src='models/captcha.php' style='width:300px; margin-top:30px;'></center><p></div>
</div>

<div class='form-group'>
<label class='col-sm-3 control-label'>Captcha*:</label>
<div class='col-sm-9'>
<input type='text' class='form-control' data-validation='length' data-validation-length='min1'' name='captcha' value=''>
</div>
</div>

<div class='login_submit'>
<button class='btn btn-lg btn-primary btn-block login-submit' type='submit'>Register</button>
</div>

<div class='text-center'><center>
<br/>
</center>
</div>
</form>

</form>


		
</div>
<div class='modal-footer'>
</div>
</div>
</div>
</div>
";

//login box
echo "<div class='modal fade ontop' id='modalLogin' tabindex='' role='dialog' aria-labelledby='modalLogin' 
aria-hidden='true' style='z-index:9999;'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header'>
<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
<h4 class='modal-title' id='myModalLabel'>Login</h4>
</div>
<div class='modal-body'>
		<form action='scripts/login.php' class='form-horizontal' id='login_form' method='post'>
		<input type='hidden' name='formid' value='login'>";
	$strerrors = $_GET['errors'];
	$strsuccesses = $_GET['successes'];
	$errors = unserialize($strerrors);
	$successes = unserialize($strsuccesses);
	if (is_array($errors))
	{
	echo resultBlock($errors,$successes);		
	}
		echo "<div class='form-group'>
		<label for='inputEmail3' class='col-sm-2 control-label'>Username:</label>
		<div class='col-sm-10'>
		<input type='text' class='form-control' data-required='true' data-minlength='2' data-required-message='Please enter a valid Username' name='username' value=''>
		</div>
		</div>
		
		<div class='form-group'>
		<label for='inputEmail3' class='col-sm-2 control-label'>Password:</label>
		<div class='col-sm-10'>
		<input type='password' class='form-control' data-required='true' data-minlength='6' data-minlength-message='Password should have at least 6 characters.' data-required-message='Please enter a valid Password' name='password' value=''>
		</div>
		</div>
		
		<div class='login_submit'>
		<button class='btn btn-lg btn-primary btn-block login-submit' type='submit'>Login</button>
		</div>
		
		<div class='text-center'><center>
		<br/>
		<small><a class='form_toggle' href='forgot-password.php'>Forgot Password</a> | <a class='form_toggle' href='register.php'>Sign up here</a></small><br/>
		</center>
		</div>
		
		</form>
</div>
<div class='modal-footer'>
</div>
</div>
</div>
</div>";

//forgot password
echo "
<div class='modal fade ontop' id='modalFP' tabindex='' role='dialog' aria-labelledby='modalFP' 
aria-hidden='true' style='z-index:9999;'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header'>
<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
<h4 class='modal-title' id='myModalLabel'>Forgot Password</h4>
</div>
<div class='modal-body'>
		<form action='scripts/forgotpassword.php' class='form-horizontal' id='fp_form' method='post' 
		style='padding-left:20px; padding-right:20px;'>
		<input type='hidden' name='formid' value='fp'>";
		$strerrors = $_GET['errors'];
		$strsuccesses = $_GET['successes'];
		$errors = unserialize($strerrors);
		$successes = unserialize($strsuccesses);
		if (is_array($errors))
		{
		echo resultBlock($errors,$successes);		
		}
		echo "
		<div class='form-group'>
		<label for='login_username'>Username</label>
		<input type='text' class='form-control input-lg parsley-validated' name='username' value=''>
		</div>
		
		<div class='form-group'>
		<label for='email'>Email</label>
		<input type='text' class='form-control input-lg parsley-validated' data-required='true'  name='email' value=''>
		</div>
		
		<div class='login_submit'>
		<button class='btn btn-lg btn-primary btn-block login-submit' type='submit'>Forgot Password</button>
		</div>
		
		<div class='text-center'> 
		</div>
		</form>	
</div>
<div class='modal-footer'>
</div>
</div>
</div>
</div>
";

//loa upload box
echo "<div class='modal fade ontop' id='modalLoa' tabindex='' role='dialog' aria-labelledby='modalLogin'
aria-hidden='true' style='z-index:9999;'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header'>
<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
<h4 class='modal-title' id='myModalLabel'>Upload</h4>
</div>
<div class='modal-body'>

<iframe src='uploads/index.php' width='100%' height='400px;' style='overflow-x:hidden; overflow-y:hidden;'  marginheight='0' frameborder='0'
onLoad='autoResize('iframe1');'></iframe>
	
</div>
<div class='modal-footer'>
</div>
</div>
</div>
</div>";

//large User
echo "<div class='modal fade ontop' id='modalLargeUser' tabindex='' role='dialog' aria-labelledby='modalLargeUser' 
aria-hidden='true' style='z-index:9999;'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header'>
<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
<h4 class='modal-title' id='myModalLabel'>Large User</h4>
</div>
<div class='modal-body'>

<div>
		<br>
		
		
Operate a multi-site business?<br>
Operate or manage a local or national franchise?<br>
Have a large membership?<br></p>

	<p>If so we have a dedicated corporate team that work only with large consumption sites and multi-site 
	businesses. Monitoring the market and dealing at its lowest point can shave thousands of pounds off your 
	annual energy bill.</p><br>

	<p>This type of negotiation is different to SME level negotiation as it is priced directly from the “Live 
	Curve” energy market and is usually only available on the day it is tendered.</p><br>

	<p>We have many specialist supply partners for this type of contract and will achieve the supplier and 
	tariff to best suit your requirements.</p><br>

	<p>Working closely with selected partners we can also implement a strategy to consolidate multiple contract 
	end dates to one single end date for all contracts that you have.</p><br>

	<p>This is hugely popular with our larger multi-site operators as it allows for a one time review of all 
	sites rather than multiple reviews and also means that you go to market with a larger consumption 
	increasing your buying power.</p><br>
	
	<p>Contact Us and ask to speak to our Corporate Team to discuss your needs, there’s no obligation and we 
	will happily discuss the process with you.</p><br>

		
		
		
	
		</div>

</div>
<div class='modal-footer'>
</div>
</div>
</div>
</div>";

//Forum
echo "<div class='modal fade ontop' id='modalForum' tabindex='' role='dialog' aria-labelledby='modalForum' 
aria-hidden='true' style='z-index:9999;'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header'>
<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
<h4 class='modal-title' id='myModalLabel'><p>Please Sign to view the EBN Forum, if you dont have an account please register</p></h4>
</div>
<div class='modal-body'>
<div>

<img src='http://www.energybuyersnetwork.com/images/forumscreenshot.jpg' width='100%'>
		
		</div>

</div>
<div class='modal-footer'>
</div>
</div>
</div>
</div>";

//Energy
echo "<div class='modal fade ontop' id='modalEnergy' tabindex='' role='dialog' aria-labelledby='modalEnergy' 
aria-hidden='true' style='z-index:9999;'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header'>
<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
<h4 class='modal-title' id='myModalLabel'>Please Sign to view the energy prices, if you dont have an account please register.</</h4>
</div>
<div class='modal-body'>

<div>
<img src='http://www.energybuyersnetwork.com/images/graphscreenshot.jpg' width='100%'>
		
		</div>

</div>
<div class='modal-footer'>
</div>
</div>
</div>
</div>";  

//Thankyou 
echo "<div class='modal fade ontop' id='modalContact' tabindex='' role='dialog' aria-labelledby='modalContact' 
aria-hidden='true' style='z-index:9999;'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header'>
<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
<h4 class='modal-title' id='myModalLabel'>Thankyou</</h4>
</div>
<div class='modal-body'>
		<img src='images/logo.png' height='100px' width='100%'>
		<p>Thanks for contacting the Energy Buyers Network, your email has been recieved, 
		we will be in touch shortly.</p><br>
		<p>Best Regards, EBN.</p>
		
</div>
<div class='modal-footer'>
</div>
</div>
</div>
</div>";


?>