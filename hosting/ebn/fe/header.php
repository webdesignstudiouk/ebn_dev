<?php
require_once("models/config.php");

echo"
<!DOCTYPE html>
<html class='csstransforms csstransforms3d csstransitions'><head>
<title>EBN - ".$page."</title>
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'>


<!-- Stylesheets -->
<link rel='stylesheet' href='css/animate.css'>
<link rel='stylesheet' href='css/bootstrap.css'>
<link rel='stylesheet' href='css/font-awesome.min.css'>
<link rel='stylesheet' href='css/owl.carousel.css'>
<link rel='stylesheet' href='css/owl.theme.css'>
<link rel='stylesheet' href='css/prettyPhoto.css'>
<link rel='stylesheet' href='css/theme.css'>
<link rel='stylesheet' href='css/responsive.css'>

<!-- Javascripts --> 
<script type='text/javascript' src='js/jquery-1.11.0.min.js'></script> 
<script type='text/javascript' src='js/bootstrap.min.js'></script> 
<script type='text/javascript' src='js/bootstrap-hover-dropdown.min.js'></script> 
<script type='text/javascript' src='js/owl.carousel.min.js'></script> 
<script type='text/javascript' src='js/jquery.parallax-1.1.3.js'></script>
<script type='text/javascript' src='js/jquery.nicescroll.js'></script>  
<script type='text/javascript' src='js/jquery.prettyPhoto.js'></script> 
<script type='text/javascript' src='js/jquery-ui-1.10.4.custom.min.js'></script> 
<script type='text/javascript' src='js/jquery.jigowatt.js'></script> 
<script type='text/javascript' src='js/waypoints.min.js'></script> 
<script type='text/javascript' src='js/jquery.isotope.min.js'></script> 
<script type='text/javascript' src='js/jquery.gmap.min.js'></script>


<!--Start of Tawk.to Script-->
<script type='text/javascript'>
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement('script'),s0=document.getElementsByTagName('script')[0];
s1.async=true;
s1.src='https://embed.tawk.to/563f7383eb4028f73bab2240/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script--> 

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-35085084-1', 'auto');
  ga('send', 'pageview');

</script>
";

$formId = $_GET['formid'];
if ($formId == "modalLogin"){echo "
<script type='text/javascript'>
    $(window).load(function(){
        $('#modalLogin').modal('show');
    });
</script>";
}

if ($formId == "modalRegister"){echo "
<script type='text/javascript'>
    $(window).load(function(){
        $('#modalRegister').modal('show');
    });
</script>";
}

if ($formId == "modalFP"){echo "
<script type='text/javascript'>
    $(window).load(function(){
        $('#modalFP').modal('show');
    });
</script>";
}

if ($formId == "modalLargeUser"){echo "
<script type='text/javascript'>
    $(window).load(function(){
        $('#modalLargeUser').modal('show');
    });
</script>";
}

if ($formId == "modalForum"){echo "
<script type='text/javascript'>
    $(window).load(function(){
        $('#modalForum').modal('show');
    });
</script>";
}

if ($formId == "modalEnergy"){echo "
<script type='text/javascript'>
    $(window).load(function(){
        $('#modalEnergy').modal('show');
    });
</script>";
}

echo"
</head>

<body>

<header >
<div class='container container-fluid'>
<div class='topbar'>
	<div class='navbar yamm navbar-default' >
		<div class='navbar-header hidden-sm hidden-md'>
		<button type='button' data-toggle='collapse' data-target='#navbar-collapse-grid' class='navbar-toggle'> 
		<span class='icon-bar'></span> 
		<span class='icon-bar'></span> 
		<span class='icon-bar'></span> 
		</button>
		<div class='branding hidden-sm'>
		<a href='home.php' class='navbar-brand'>         
		<div id='logo'> 
		<img id='default-logo' src='images/logo.png' alt='Energy Buyers Network' style='height:110px;'> 
		<img id='retina-logo' src='images/logo.png' alt='Energy Buyers Network' style='height:110px;'> 
		</div>
		</a> 
		</div>
		</div>

		<div id='navbar-collapse-grid' class='navbar-collapse collapse' style='width:100%; overflow:hidden;'>
		<ul class='nav navbar-nav'>
		
		<li class='";
		if ($page == "Home"){echo "active";}else{}
		echo "'><a href='home.php'>Home</a></li>
		
		<li class='";
		if ($page == "Together We're Stronger"){echo "active";}else{}
		echo "'><a href='togetherwerestronger.php'>Together We're Stronger</a></li>
		
		<li class='";
		if ($page == "Rollover And Termination"){echo "active";}else{}
		echo "'><a href='rolloverandtermination.php'>Rollover And Termination</a></li>
		
		<li class='";
		if ($page == "Benefits"){echo "active";}else{}
		echo "'><a href='benefits.php'>Benefits</a></li>
		
		<li class='";
		if ($page == "Partners"){echo "active";}else{}
		echo "'><a href='partners.php'>Partners</a></li>  
		
		<li class='";
		if ($page == "LOA"){echo "active";}else{}
		echo "'><a href='loa.php'>LOA</a></li>
		
		<li class='";
		if ($page == "Contact Us"){echo "active";}else{}
		echo "'><a href='contactus.php'>Contact Us</a></li>
		</ul>
	</div>
	</div>
</div></div>
</header>";

require_once("modals.php");

?>