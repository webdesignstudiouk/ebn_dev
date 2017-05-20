<?php

require_once("includes/header.php");

echo "
<style>
.slider-heading {
	background-image: url('assets/images/slider-bg.jpg');
	background-size: 100% 100%;
    background-repeat: no-repeat;
	height:550px;
}

.slider-heading h1 {
	text-align:center;	
	margin-top:80px;
	background-size: 100% 100%;
    background-repeat: no-repeat;
	font-family: 'Quicksand', Aerial, sans-serif;
	font-weight:900;
	color: #fff;
}

.slider-heading h2 {
	text-align:center;	
	margin-top:300px;
	background-size: 100% 100%;
    background-repeat: no-repeat;
	font-family: 'Quicksand', Aerial, sans-serif;
	font-weight:300;
	color: #fff;
}
</style>

<div class='my-slider' style='margin-bottom:20px!important;'>
	<ul>
	<li class='slider-heading'>
               <h1>Dragon Utilities.com</h1>
               <h2>Electricity | Gas | Water</h1>
         </li>
		 
	<li class='slider-heading'>
			   <h1>GET IN TOUCH</h1>
			   <div class='row'>
			   		<div class='col-md-offset-2 col-md-3' style='margin-bottom:20px;'>
						<h2>5 charlotte square<br/>
						Newcastle Upon Tyne<br/>
						NE1 4XF</h2>
					</div>
					<div class='col-md-offset-2 col-md-3'>
						<h2>01913726509<br/>
						admin@dragonutilities.com</h2>
					</div>
				</div>
		</div>
         </li>
	</ul>
</div>
	
    <div class='container'>
		<div class='row'>
			<div class='span9'>
				<div class='headline' style='margin-bottom:20px!important'>
					<h2>All you need to know</h2>
				</div>
				<div class='row'>
					<div class='span12'>
						<div class='row'>
							<div class='span12'>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class='span3'>
				<div class='headline' style='margin-bottom:20px!important'>
					<h2>Request A Callback</h2>
				</div>
				",$callbackWidget,"
			</div>
		</div> 
	</div>

  
";

require_once("includes/footer.php");

?>
