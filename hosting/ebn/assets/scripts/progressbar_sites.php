<?php

//////////////////////////////////////////////////////////////////Site Progress Bar
function progressbar_user($id){
$userdetailspb = fetchUserDetails(NULL, NULL, $id);

if ($userdetailspb['first_name'] == '') {} else { $first_name = "11.1"; }
if ($userdetailspb['second_name'] == '') {} else { $second_name = "11.1"; }
if ($userdetailspb['email'] == '') {} else { $email = "11.2"; }
if ($userdetailspb['phonenumber'] == '') {} else { $phonenumber = "11.1"; }
if ($userdetailspb['company'] == '') {} else { $company = "11.1"; }
if ($userdetailspb['street'] == '') {} else { $street = "11.1"; }
if ($userdetailspb['town'] == '') {} else { $town = "11.1"; }
if ($userdetailspb['city'] == '') {} else { $city = "11.1"; }
if ($userdetailspb['postcode'] == '') {} else { $postcode = "11.1"; }

$progressbar_total = $first_name + $second_name + $email + $phonenumber + $company + $street + $town + $city + $postcode;
 
echo $progressbar_total;
}
 
//////////////////////////////////////////////////////////////////Site Progress Bar
function progressbar_sites($sid){
$sitedetails = fetchSiteDetails($sid);

if ($sitedetails['name'] == '') {} else { $name = "16.6"; }
if ($sitedetails['company'] == '') {} else { $company = "16.6"; }
if ($sitedetails['street'] == '') {} else { $street = "16.7"; }
if ($sitedetails['town'] == '') {} else { $town = "16.7"; }
if ($sitedetails['city'] == '') {} else { $city = "16.7"; }
if ($sitedetails['postcode'] == '') {} else { $postcode = "16.7"; }

$progressbar_total = $name + $company + $street + $town + $city + $postcode;
 
echo $progressbar_total;
}

//////////////////////////////////////////////////////////////////Electric Meter Progress Bar
function progressbar_emeter($mid){
$meterdetails = fetchMeterDetails($mid);

if ($meterdetails['v1'] == '') {} else { $v1 = "14.3"; }
if ($meterdetails['v2'] == '') {} else { $v2 = "14.3"; }
if ($meterdetails['v3'] == '') {} else { $v3 = "14.3"; }
if ($meterdetails['v4'] == '') {} else { $v4 = "14.3"; }
if ($meterdetails['v5'] == '') {} else { $v5 = "14.3"; }
if ($meterdetails['v6'] == '') {} else { $v6 = "14.3"; }
if ($meterdetails['v7'] == '') {} else { $v7 = "14.2"; }

$progressbar_total = $v1 + $v2 + $v3 + $v4 + $v5 + $v6 + $v7;
if ($progressbar_total == '0') {
}else{
echo $progressbar_total;
}
}

//////////////////////////////////////////////////////////////////Gas Meter Progress Bar
function progressbar_gmeter($mid){
$meterdetails = fetchMeterDetails($mid);

if ($meterdetails['v1'] == '') {} else { $v1 = "100"; }
$progressbar_total = $v1;
echo $progressbar_total;
}

//////////////////////////////////////////////////////////////////Contract Progress Bar
function progressbar_contracts($cid){
$contractdetails = fetchContractDetails($cid);

if ($contractdetails['loa'] == 'yes') { $loa = "4.5"; }
if ($contractdetails['bill'] == 'yes') { $bill = "4.5"; }
if ($contractdetails['cedconfirmed'] == '') {} else { $cedconfirmed = "4.5"; }
if ($contractdetails['cedconfirmedv'] == 'yes') { $cedconfirmedv = "4.5"; }
if ($contractdetails['eacconfirmed'] == '') {} else { $eacconfirmed = "4.5"; }
if ($contractdetails['eacconfirmedv'] == 'yes') { $eacconfirmedv = "4.5"; }
if ($contractdetails['supplier'] == '') {} else { $supplier = "4.5"; }
if ($contractdetails['terminationlodged'] == '') {} else { $terminationlodged = "4.5"; }
if ($contractdetails['terminationlodgedv'] == 'yes') { $terminationlodgedv = "4.5"; }
if ($contractdetails['terminationacceppted'] == '') {} else { $terminationacceppted  = "4.5"; }
if ($contractdetails['terminationaccepptedv'] == 'yes') { $terminationaccepptedv = "4.5"; }
if ($contractdetails['terminationwindowopen'] == '') {} else { $terminationwindowopen  = "4.5"; }
if ($contractdetails['terminationwindowopenv'] == 'yes') { $terminationwindowopenv = "4.6"; }
if ($contractdetails['terminationwindowcloses'] == '') {} else { $terminationwindowcloses  = "4.6"; }
if ($contractdetails['terminationwindowclosesv'] == 'yes') { $terminationwindowclosesv = "4.6"; }
if ($contractdetails['kva'] == '') {} else { $kva  = "4.6"; }
if ($contractdetails['annualspend'] == '') {} else { $annualspend  = "4.6"; }
if ($contractdetails['rate1'] == '') {} else { $rate1  = "4.6"; }
if ($contractdetails['rate2'] == '') {} else { $rate2  = "4.6"; }
if ($contractdetails['rate3'] == '') {} else { $rate3  = "4.6"; }
if ($contractdetails['rate4'] == '') {} else { $rate4  = "4.6"; }
if ($contractdetails['rate5'] == '') {} else { $rate5  = "4.6"; }

$progressbar_total = $loa + $bill + $cedconfirmed + $cedconfirmedv + $eacconfirmed + $eacconfirmedv + $supplier + $terminationlodged + $terminationlodgedv +
$terminationacceppted + $terminationaccepptedv + $terminationwindowopen + $terminationwindowopenv + $terminationwindowcloses + $terminationwindowclosesv +
$kva + $annualspend + $rate1 + $rate2 + $rate3 + $rate4 + $rate5;

echo $progressbar_total;
}

//////////////////////////////////////////////////////////////////Overall Progress Bar
function progressbar_overall($sid, $mid, $cid){
$sitedetails = fetchSiteDetails($sid);
$meterdetails = fetchMeterDetails($mid);
$contractdetails = fetchContractDetails($cid);

if ($sitedetails['name'] == '') {} else { $name = "2.8"; }
if ($sitedetails['company'] == '') {} else { $company = "2.8"; }
if ($sitedetails['street'] == '') {} else { $street = "2.8"; }
if ($sitedetails['town'] == '') {} else { $town = "2.8"; }
if ($sitedetails['city'] == '') {} else { $city = "2.8"; }
if ($sitedetails['postcode'] == '') {} else { $postcode = "2.8"; }

if ($meterdetails['type'] == 'gas') {
if ($meterdetails['v1'] == '') {} else { $v1 = "19.6"; }
} else { 
if ($meterdetails['v1'] == '') {} else { $v1 = "2.8"; }
if ($meterdetails['v2'] == '') {} else { $v2 = "2.8"; }
if ($meterdetails['v3'] == '') {} else { $v3 = "2.8"; }
if ($meterdetails['v4'] == '') {} else { $v4 = "2.8"; }
if ($meterdetails['v5'] == '') {} else { $v5 = "2.8"; }
if ($meterdetails['v6'] == '') {} else { $v6 = "2.8"; }
if ($meterdetails['v7'] == '') {} else { $v7 = "2.8"; } }



if ($contractdetails['loa'] == 'yes') { $loa = "2.8"; }
if ($contractdetails['bill'] == 'yes') { $bill = "2.8"; }
if ($contractdetails['cedconfirmed'] == '') {} else { $cedconfirmed = "2.8"; }
if ($contractdetails['cedconfirmedv'] == 'yes') { $cedconfirmedv = "2.8"; }
if ($contractdetails['eacconfirmed'] == '') {} else { $eacconfirmed = "2.8"; }
if ($contractdetails['eacconfirmedv'] == 'yes') { $eacconfirmedv = "2.8"; }
if ($contractdetails['supplier'] == '') {} else { $supplier = "2.8"; }
if ($contractdetails['terminationlodged'] == '') {} else { $terminationlodged = "2.8"; }
if ($contractdetails['terminationlodgedv'] == 'yes') { $terminationlodgedv = "2.8"; }
if ($contractdetails['terminationacceppted'] == '') {} else { $terminationacceppted  = "2.8"; }
if ($contractdetails['terminationaccepptedv'] == 'yes') { $terminationaccepptedv = "2.8"; }
if ($contractdetails['terminationwindowopen'] == '') {} else { $terminationwindowopen  = "2.8"; }
if ($contractdetails['terminationwindowopenv'] == 'yes') { $terminationwindowopenv = "2.8"; }
if ($contractdetails['terminationwindowcloses'] == '') {} else { $terminationwindowcloses  = "2.8"; }
if ($contractdetails['terminationwindowclosesv'] == 'yes') { $terminationwindowclosesv = "2.8"; }
if ($contractdetails['kva'] == '') {} else { $kva  = "4.6"; }
if ($contractdetails['annualspend'] == '') {} else { $annualspend  = "2.8"; }
if ($contractdetails['rate1'] == '') {} else { $rate1  = "2.8"; }
if ($contractdetails['rate2'] == '') {} else { $rate2  = "2.8"; }
if ($contractdetails['rate3'] == '') {} else { $rate3  = "2.8"; }
if ($contractdetails['rate4'] == '') {} else { $rate4  = "2.9"; }
if ($contractdetails['rate5'] == '') {} else { $rate5  = "2.9"; }

$progressbar_total = $name + $company + $street + $town + $city + $postcode + $v1 + $v2 + $v3 + $v4 + $v5 + $v6 + $v7 + $loa + $bill + $cedconfirmed + $cedconfirmedv + 
$eacconfirmed + $eacconfirmedv + $supplier + $terminationlodged + $terminationlodgedv + $terminationacceppted + $terminationaccepptedv + $terminationwindowopen + 
$terminationwindowopenv + $terminationwindowcloses + $terminationwindowclosesv + $kva + $annualspend + $rate1 + $rate2 + $rate3 + $rate4 + $rate5;
 
echo $progressbar_total;
}




?>