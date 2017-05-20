<?php
$type = "admin";
$title = "Advertisements";
require_once("../models/config.php");
require_once("../includes/header.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

echo $navbar_admin;
echo $before_body;
echo resultBlock($errors,$successes);





echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>
 