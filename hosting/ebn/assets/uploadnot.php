<?php 
if($_SERVER['REQUEST_METHOD']=="POST")
{
$fromemail="Dont Reply <info@energybuyersnetwork.com>"; // change here if you want
$toemail="michael.k.taylor@live.co.uk";   // change here if you want
$sub="Something Has Been Uploaded!";          // change here if you want

$contentmsg=stripslashes("<br><b><font style=color:#000000>$sub</font></b><br><br/>
<p>Something has been uploaded to the Energy Buyers Network.</p>
");

$headers  = "MIME-Version: 1.0";
$headers .= "Content-type: text/html; charset=iso-8859-1";
				
$from=$fromemail;
				
$headers .= "From: ".$from." 
";				
@mail($toemail,$sub,$contentmsg,$headers);				
header('Location: http://www.energybuyersnetwork.com/thankyou.php');
}
?>

