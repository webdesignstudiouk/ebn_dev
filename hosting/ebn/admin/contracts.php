<?php
$type = "admin";
$title = "Contracts";
require_once("../models/config.php");
$contractData = fetchcontracts(); //Fetch information for all users
if (!securePage($_SERVER['PHP_SELF'])){die();}

//Forms posted
if(!empty($_POST))
{
	$contracts_h = $_POST['hide'];
	contracthide($contracts_h);
	header("Location: contracts.php");
}
require_once("../includes/header.php");
echo $navbar_admin;
echo $before_body;
echo resultBlock($errors,$successes);

echo "<h1 class='heading_a'>My Clients Contracts</h1>";
echo "<table class='table table-condensed'>
<thead>
<tr>
<th>id</th>
<th>Clients Name</th>
<th>Site Name</th>
<th>Termination Window Closes</th>
<th>Hidden From Agents</th>
<th>View</th>
</tr>
</thead>
<form name='adminUsers' action='".$_SERVER['PHP_SELF']."' method='post'>
";

foreach ($contractData as $v1) {
$meterdetails_hd = fetchMeterDetails($v1['meter_id']);
$sitedetails_hd = fetchSiteDetails($meterdetails_hd['site_id']);
$user_hd = $userdetails = fetchUserDetails(NULL, NULL, $sitedetails_hd['user_id']);
$terminationwindowopenv = str_replace('/', '-', $v1['terminationwindowopen']);
$terminationwindowopen = strtotime($terminationwindowopenv);
$terminationwindowclosesv = str_replace('/', '-', $v1['terminationwindowcloses']);
$terminationwindowcloses = strtotime($terminationwindowclosesv);
$todayv = str_replace('/', '-', $today);
$today1 = strtotime($todayv);
$min_date = min($today1, $terminationwindowcloses);
$max_date = max($today1, $terminationwindowcloses);
$i = 0;
while (($min_date = strtotime("+1 MONTH", $min_date)) <= $max_date) {
    $i++;
}



echo "<tr>
<td>".$v1['id']."</td>
<td>".$user_hd['first_name']." ".$user_hd['second_name']."</td>
<td>".$sitedetails_hd['name']."</td>
<td>".$v1['terminationwindowcloses']."</td>
<td><center><input type='checkbox' name='hide[".$v1['id']."]' id='hide[".$v1['id']."]' ";
	if ($v1['hidden'] == "1"){
		echo "checked='checked'";	
	}
echo" value='".$v1['id']."'></center></td>
<td><a href='${websiteUrl}agents/sites.php?id=", $sitedetails_hd['user_id'], "&sid=", $sitedetails_hd['id'], "&mid=", $v1['meter_id'], "&cid=", $v1['id'], "'>View Contract</a></td>
<td></tr>";
}





echo "</table><button class='next_step btn btn-primary' style='float:right; margin-top:20px; margin-right:50px;' class='btn btn-primary'>Update Contracts</button></form>";

echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>

