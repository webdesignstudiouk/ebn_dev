<?php ob_start();
$fromemail="Dont Reply <info@energybuyersnetwork.com>"; // change here if you want
$toemail="michael.k.taylor@live.co.uk";   // change here if you want
$sub="Forgot Password | Energy Buyers Network";          // change here if you want
$success_page_name="../index.php";
////// do not change in following
if($_SERVER['REQUEST_METHOD']=="POST")
{
$fieldnm_1=str_replace ( array("\n"), array("<br>"),trim($_REQUEST['fieldnm_1']));  
$fieldnm_2=str_replace ( array("\n"), array("<br>"),trim($_REQUEST['fieldnm_2']));  
$fieldnm_3=str_replace ( array("\n"), array("<br>"),trim($_REQUEST['fieldnm_3']));  
$fieldnm_4=str_replace ( array("\n"), array("<br>"),trim($_REQUEST['fieldnm_4']));  
$fieldnm_5=str_replace ( array("\n"), array("<br>"),trim($_REQUEST['fieldnm_5']));  


$contentmsg=stripslashes("<br><b><font style=color:#000000>$sub</font></b><br><br/>
<table width=708 border=0 cellpadding=2 cellspacing=1 bgcolor=#ffffff>
<tr>
<td width=165 align=right valign=top bgcolor=#FFFFFF><B>Full Name *:</b> </td>
<td width=565 align=left valign=top bgcolor=#FFFFFF>$fieldnm_1</td>
</tr>

<tr>
<td width=165 align=right valign=top bgcolor=#FFFFFF><B>Email *:</b> </td>
<td width=565 align=left valign=top bgcolor=#FFFFFF>$fieldnm_2</td>
</tr>

<tr>
<td width=165 align=right valign=top bgcolor=#FFFFFF><B>Display Name *:</b> </td>
<td width=565 align=left valign=top bgcolor=#FFFFFF>$fieldnm_3</td>
</tr>

<tr>
<td width=165 align=right valign=top bgcolor=#FFFFFF><B>Company:</b> </td>
<td width=565 align=left valign=top bgcolor=#FFFFFF>$fieldnm_4</td>
</tr>

<tr>
<td width=165 align=right valign=top bgcolor=#FFFFFF><B>Phone Number *:</b> </td>
<td width=565 align=left valign=top bgcolor=#FFFFFF>$fieldnm_5</td>
</tr>

</table>
");

////
$headers  = "MIME-Version: 1.0
";
$headers .= "Content-type: text/html; charset=iso-8859-1
";

$from=$fromemail;

$headers .= "From: ".$from." 
";

@mail($toemail,$sub,$contentmsg,$headers);

header('Location: http://www.energybuyersnetwork.com/thankyou.php');

}
?>

