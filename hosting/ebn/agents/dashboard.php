<?php
$type = "agent";
require_once("../models/config.php");
$agentfname = $loggedInUser->firstname;
$agentsname = $loggedInUser->secondname; 
$title = "${agentfname} ${agentsname} > Dashboard ";
if (!securePage($_SERVER['PHP_SELF'])){die();}
$userdetails = fetchUserDetails(NULL, NULL, $loggedInUser->user_id);

require_once("../includes/header.php");
echo $navbar_agents;
echo $before_body;
echo resultBlock($errors,$successes);

echo "
<div class='row'>
<div class='col-sm-6'>
<div class='box_stat_circular'>
<div class='box_stat_circular_a color_a'>
<h4>";
countmyclients ($userdetails['id']);
echo "</h4>
<small>Clients Assigned To You</small>
</div>
<div class='box_stat_circular_middle'>
<div class='easy_chart easy_chart_a easyPieChart' data-percent='42' style='width: 70px; height: 70px; line-height: 70px;'><i class='glyphicon glyphicon-user'></i><canvas width='70' height='70'></canvas></div>
</div>
<div class='box_stat_circular_b'>
<p>Click Here To View Your Clients</p>
<a class='btn btn-primary' href='my_clients.php'>Click Here</a>
</div>
</div>
</div>
<div class='col-sm-6'>
<div class='box_stat_circular'>
<div class='box_stat_circular_a color_b'>
<h4>";
countmyprospects ($userdetails['id']);
echo "</h4>
<small>Prospects Assigned To You</small>
</div>
<div class='box_stat_circular_middle'>
<div class='easy_chart easy_chart_a easyPieChart' data-percent='42' style='width: 70px; height: 70px; line-height: 70px;'><i class='glyphicon glyphicon-user'></i><canvas width='70' height='70'></canvas></div>
</div>
<div class='box_stat_circular_b'>
<p>Click Here To View Your Prospects</p>
<a class='btn btn-primary' href='prospects.php'>Click Here</a>
</div>
</div>
</div>
</div>
";

//footer
echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>