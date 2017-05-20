<?php ob_start();

require_once("../models/config.php");

$fromemail="Dont Reply <enquiries@dragonutilities.com>"; // change here if you want
$toemail="enquiries@dragonutilities.com";   // change here if you want
$sub="Message From Dragon Utilities";          // change here if you want
 
if($_SERVER['REQUEST_METHOD']=="POST")
{
$fieldnm_1=str_replace ( array("\n"), array("<br>"),trim($_REQUEST['name']));  
$fieldnm_2=str_replace ( array("\n"), array("<br>"),trim($_REQUEST['email']));  
$fieldnm_3=str_replace ( array("\n"), array("<br>"),trim($_REQUEST['phonenumber']));  
 

$contentmsg=stripslashes("

$emailheader       

<tr>          
<td valign='top' width='50' height='41' bgcolor='#ffffff'>&nbsp;</td>          
<td valign='top' width='391' height='41' colspan='2' bgcolor='#ffffff'>            
<p style='font-family:georgia;font-size:12px;font-style:italic;color:#000000;'>Hello,</p>            
<p style='font-family:georgia;font-size:12px;font-style:italic;color:#000000;'>
You have recieved a email from the Dragon Utilities website from the <b>CALLBACK FORM</b>
</p>         

	<p style='font-family:helvetica;font-size:12px;font-weight:bold;color:#000000;'>DETAILS ARE BELOW:<br>              
	<span style='font-weight:normal;'></span></p>              
	<table width='100%' cellpadding='6' cellspacing='0' border='0' bgcolor='#ffffff' style='font-family:helvetica;font-size:12px;font-weight:bold;color:#000000;'>                
	<tbody>
	
	<tr>                  
	<td width='10%' align='left' valign='middle' style='border-bottom:1px solid #aaaaaa;border-top:1px solid #aaaaaa;'>Label</td>   
	<td width='10%' align='left' valign='middle' nowrap='' style='border-bottom:1px solid #aaaaaa;border-top:1px solid #aaaaaa;'>&nbsp;</td>    
	<td width='60%' align='left' valign='middle' nowrap='' style='border-bottom:1px solid #aaaaaa;border-top:1px solid #aaaaaa;'>Value</td>  
	<td width='10%' align='left' valign='middle' nowrap='' style='border-bottom:1px solid #aaaaaa;border-top:1px solid #aaaaaa;'>&nbsp;</td>    
      
	</tr>                                
	
		<tr><td class='body' valign='top'>Name:</td><td class='body' valign='top'>&nbsp;</td>
		<td align='left' class='body' valign='top'>$fieldnm_1</td><td align='right' class='body' valign='top'>&nbsp;</td></tr>
		
		<tr><td class='body' valign='top'>Email:</td><td class='body' valign='top'>&nbsp;</td>
		<td align='left' class='body' valign='top'>$fieldnm_2</td><td align='right' class='body' valign='top'>&nbsp;</td></tr>
    
		<tr><td class='body' valign='top'>Phone Number:</td><td class='body' valign='top'>&nbsp;</td>
		<td align='left' class='body' valign='top'>$fieldnm_3</td><td align='right' class='body' valign='top'>&nbsp;</td></tr>	
    	
	<tr>                                
	</tbody>
	</table>     
</br>	
<center>		
<p style='font-family:helvetica;font-size:12px;font-weight:bold;color:#000000;'>The Dragon Utilities Team!</p>  
</center>                  
</td>        
</tr>        

$emailfooter
	
");

////
$headers  = "MIME-Version: 1.0
";
$headers .= "Content-type: text/html; charset=iso-8859-1
";
				
$from=$fromemail;
				
$headers .= "From: ".$from." 
";
				
mail($toemail,$sub,$contentmsg,$headers);

$message = "success"; 

header("Location: ../thankyou.php");
}
?>

