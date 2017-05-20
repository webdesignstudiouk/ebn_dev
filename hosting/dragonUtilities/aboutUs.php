<?php

require_once("includes/header.php");

echo "
<div id='content'>

	<div id='page-header' style='background: #dfbc5e;'>
		<div class='container'> 
			<div class='row' style='padding-bottom:0px; margin-bottom:0px;'> 
				<div class='span6'>
					<h2 style='float:left'>About Us</h2>
				</div>
				<div class='span6'>
					<ul class='links'>
						<li><a href='index.php'>Home</a>/</li>
						<li><a href='aboutUs.php'>About Us</a></li>
					</ul>	
				</div>		
			</div>
		</div>
    </div>
	
    <div class='container'>
		<div class='row'>
			<div class='span9'>
				<div class='headline' style='margin-bottom:20px!important'>
					<h2>Who Are We?</h2>
				</div>
				<div class='row'>
					<div class='span12'>
						<div class='row'>
							<div class='span12'>
								<p>We are based in Chinatown, Newcastle Upon Tyne and have clients nationally, we don’t have to visit you to be able to save you money and have a very 
								transparent and effective process to save you money.</p>
								<p>Working in partnership with the Energy Buyers Network we take advantage of preferential rates due to the expertise in energy procurement, experience 
								and time in the energy sector and utilising the power of “Combined Consumption Purchasing”.</p>
								<p>If you run a takeaway, restaurant, supermarket or shop, involved in manufacturing or import we are confident that we can secure the best deal for you 
								for your Gas, Electricity and Water.</p>
								<p>We offer a Free, no obligation service so there’s nothing to lose and everything to gain by speaking to us about your utility costs.</p>
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
