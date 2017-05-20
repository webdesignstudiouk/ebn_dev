<?php

require_once("includes/header.php");

echo "
<div id='content'>

	<div id='page-header' style='background: #dfbc5e;'>
		<div class='container'> 
			<div class='row' style='padding-bottom:0px; margin-bottom:0px;'> 
				<div class='span6'>
					<h2 style='float:left'>Our Partners</h2>
				</div>
				<div class='span6'>
					<ul class='links'>
						<li><a href='index.php'>Home</a>/</li>
						<li><a href='partners.php'>Our Partners</a></li>
					</ul>	
				</div>		
			</div>
		</div>
    </div>
	
    <div class='container'>
		<div class='row'>
			<div class='span9'>
				<div class='headline' style='margin-bottom:20px!important'>
					<h2>Our supply partners!</h2>
				</div>
				<div class='row'>
					<div class='span12'>
						<div class='row'>
							<div class='span12'>
								<p>We work with the \"Big 6\" energy suppliers and many specialist commercial energy suppliers which gives us confidence in our ability to 
								secure you the best deal in the market at renewal. See below suppliers that we work with :</p>
								<img src='assets/images/partners.jpg' width='100%;'/>
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
