<?php ob_start();

require_once("../models/config.php");

$fromemail="Dont Reply <info@energybuyersnetwork.com>"; // change here if you want
$toemail="ian@energybuyersnetwork.com";   // change here if you want
$sub="Message From Energy Buyers Network";          // change here if you want
 
if($_SERVER['REQUEST_METHOD']=="POST")
{
$fieldnm_1=str_replace ( array("\n"), array("<br>"),trim($_REQUEST['fullname']));  
$fieldnm_2=str_replace ( array("\n"), array("<br>"),trim($_REQUEST['email']));  
$fieldnm_3=str_replace ( array("\n"), array("<br>"),trim($_REQUEST['phonenumber']));  
$fieldnm_4=str_replace ( array("\n"), array("<br>"),trim($_REQUEST['company']));  
$fieldnm_5=str_replace ( array("\n"), array("<br>"),trim($_REQUEST['message']));  


$contentmsg=stripslashes("

$emailheader       

<tr>          
<td valign='top' width='50' height='41' bgcolor='#ffffff'>&nbsp;</td>          
<td valign='top' width='391' height='41' colspan='2' bgcolor='#ffffff'>            
<p style='font-family:georgia;font-size:12px;font-style:italic;color:#000000;'>Hello Ian</p>            
<p style='font-family:georgia;font-size:12px;font-style:italic;color:#000000;'>
You have recieved a email from the energy buyers network website from the contact page, a user has submitted some feedback / question to you, please reply to this user, the 
users email is listed below.
</p>         

	<p style='font-family:helvetica;font-size:12px;font-weight:bold;color:#000000;'>YOUR ACCOUNT DETAILS ARE BELOW:<br>              
	<span style='font-weight:normal;'></span></p>              
	<table width='100%' cellpadding='6' cellspacing='0' border='0' bgcolor='#ffffff' style='font-family:helvetica;font-size:12px;font-weight:bold;color:#000000;'>                
	<tbody>
	
	<tr>                  
	<td width='60%' align='left' valign='middle' style='border-bottom:1px solid #aaaaaa;border-top:1px solid #aaaaaa;'>Label</td>   
	<td width='10%' align='left' valign='middle' nowrap='' style='border-bottom:1px solid #aaaaaa;border-top:1px solid #aaaaaa;'>&nbsp;</td>    
	<td width='10%' align='left' valign='middle' nowrap='' style='border-bottom:1px solid #aaaaaa;border-top:1px solid #aaaaaa;'>Value</td>  
	<td width='10%' align='left' valign='middle' nowrap='' style='border-bottom:1px solid #aaaaaa;border-top:1px solid #aaaaaa;'>&nbsp;</td>    
      
	</tr>                                
	
		<tr><td class='body' valign='top'>Name:</td><td class='body' valign='top'>&nbsp;</td>
		<td align='left' class='body' valign='top'>$fieldnm_1</td><td align='right' class='body' valign='top'>&nbsp;</td></tr>
		
		<tr><td class='body' valign='top'>Email:</td><td class='body' valign='top'>&nbsp;</td>
		<td align='left' class='body' valign='top'>$fieldnm_2</td><td align='right' class='body' valign='top'>&nbsp;</td></tr>
    
		<tr><td class='body' valign='top'>Phone Number:</td><td class='body' valign='top'>&nbsp;</td>
		<td align='left' class='body' valign='top'>$fieldnm_3</td><td align='right' class='body' valign='top'>&nbsp;</td></tr>	
		    
		<tr><td class='body' valign='top'>Company:</td><td class='body' valign='top'>&nbsp;</td>
		<td align='left' class='body' valign='top'>$fieldnm_4</td><td align='right' class='body' valign='top'>&nbsp;</td></tr>
 
 		<tr><td class='body' valign='top'>Message:</td><td class='body' valign='top'>&nbsp;</td>
		<td align='left' class='body' valign='top'>$fieldnm_5</td><td align='right' class='body' valign='top'>&nbsp;</td></tr>
    	
	<tr>                                
	</tbody>
	</table>     
</br>	
<center>
<p style='font-family:helvetica;font-size:12px;'>Thank you for registering and we will be in touch as quick as we can.</p>				
<p style='font-family:helvetica;font-size:12px;font-weight:bold;color:#000000;'>The Energy Buyers Network Team!</p>  
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
				
@mail($toemail,$sub,$contentmsg,$headers);


header('Location: http://www.energybuyersnetwork.com?form=thankyou');



}
?>

