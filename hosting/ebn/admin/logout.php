<?php
require_once("../models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

if(isUserLoggedIn())
{
destroySession("userCakeUser");
}

if(!empty($websiteUrl)) 
{
$add_http = "";

if(strpos($websiteUrl,"http://") === false)
{
$add_http = "http://";
}

header("Location: http://www.energybuyersnetwork.com");
die();
}
else
{
header("Location: http://www.energybuyersnetwork.com");
die();
}	


?>

