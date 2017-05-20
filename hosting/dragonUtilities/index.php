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
               <h1 style='margin-top:260px;'>Electricity | Gas | Water</h1>
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
					<h2>Hello and welcome to Dragon Utilities!</h2>
				</div>
				<div class='row'>
					<div class='span12'>
						<div class='row'>
							<div class='span12'>
								<p>Dragon Utilities are a specialist utility procurement consultancy working within the Energy Buyers Network “partnership” framework. 
								We offer a platform for individual businesses irrespective of size, access to cheaper Gas, Electricity and Water through “Combined Consumption Purchasing”. 
								We offer fixed and flexible contracts for up to 5 years.</p>
								<p>We are not suppliers of energy however we do have 25 supply partners guaranteeing you the best available tariff in the market at the time of your renewal, 
								we simply combine consumption to access low rates on the wholesale energy market that are usually only available to large consumers of electricity and gas 
								and water.</p>
								<p>Clients retain their own supply contract with the supplier and pay their bills directly, we simply facilitate the process for the benefit of all by 
								utilising our “Combined Consumption Purchasing” platform.</p>
								<p>With Chinese speaking owners and staff you can be confident of a professional, transparent and friendly approach to saving you money.</p>
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
