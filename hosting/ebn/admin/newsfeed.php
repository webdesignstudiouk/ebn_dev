<?php
require_once("../models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

$notifcations = fetchnewsfeed();

foreach ($notifcations as $v1) {
$result = substr($v1['time'], 10, 20);

if ($v1['type'] == 'new_site') {
$sitedetails = fetchSiteDetails($v1['link']);
echo "<li class='text-center'>
<a href='${websiteUrl}agents/sites.php?id=", $sitedetails['user_id'], "&sid=", $v1['link'], "'>", $v1['type'], " | ", $result, "</a>
</li>";
}

if ($v1['type'] == 'new_electric_meter') {
$meterdetails = fetchMeterDetails($v1['link']);
$sitedetails = fetchSiteDetails($meterdetails['site_id']);
echo "<li class='text-center'>
<a href='${websiteUrl}agents/sites.php?id=", $sitedetails['user_id'], "&sid=", $sitedetails['id'], "&mid=", $v1['link'], "'>", $v1['type'], " | ", $result, "</a>
</li>";
}

if ($v1['type'] == 'new_gas_meter') {
$meterdetails = fetchMeterDetails($v1['link']);
$sitedetails = fetchSiteDetails($meterdetails['site_id']);
echo "<li class='text-center'>
<a href='${websiteUrl}agents/sites.php?id=", $sitedetails['user_id'], "&sid=", $sitedetails['id'], "&mid=", $v1['link'], "'>", $v1['type'], " | ", $result, "</a>
</li>";
}

if ($v1['type'] == 'new_contract') {
$contractdetails = fetchContractDetails($v1['link']);
$meterdetails = fetchMeterDetails($contractdetails['meter_id']);
$sitedetails = fetchSiteDetails($meterdetails['site_id']);
echo "<li class='text-center'>
<a href='${websiteUrl}agents/sites.php?id=", $sitedetails['user_id'], "&sid=", $sitedetails['id'], "&mid=", $meterdetails['id'], "&cid=", $v1['link'], "'>", $v1['type'], " | ", $result, "</a>
</li>";
}
}
?>