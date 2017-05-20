<?php
define('ga_email','michael.k.taylor@live.co.uk');
define('ga_password','K1r4d4x31246969');
define('ga_profile_id','64392291');

require 'gapi.class.php';

$ga = new gapi(ga_email,ga_password);

$ga->requestReportData(ga_profile_id,array('date'),array('visits'));
echo "
<table>
<tr>
<th>Source</th>
<th>Visits</th>
</tr>";

	foreach($ga->getResults() as $result):
	
	echo"<tr><td>";
	$r1 = substr($result, 0, 4);
	$r2 = substr($result, 4, 2);
	$r3 = substr($result, 6, 8);
	echo "$r1 $r2 $r3";
	echo"</td>";

	echo"<td>";
	echo "-";
	echo $result->getVisits();
	echo" </td></tr>";

	endforeach;

	echo"</table>";
?>