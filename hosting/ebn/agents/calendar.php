<?php
$type="agent";
$title="My Calendar";
require_once("../models/config.php");
require_once("../includes/header.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

echo $navbar_agents;
echo $before_body;
echo resultBlock($errors,$successes);



echo "<div class='panel panel-default'><div class='panel-heading'></div><div id='calendar_phases' class='fc fc-ltr'></div>";




echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>
 