<?php

require_once("includes/header.php");

echo "
<div id='content'>
	
	<div id='page-header' style='background: #dfbc5e;'>
		<div class='container'> 
			<div class='row' style='padding-bottom:0px; margin-bottom:0px;'> 
				<div class='span6'>
					<h2 style='float:left'>Contact Us</h2>
				</div>
				<div class='span6'>
					<ul class='links'>
						<li><a href='index.php'>Home</a>/</li>
						<li><a href='contactUs.php'>Contact Us</a></li>
					</ul>	
				</div>		
			</div>
		</div>
    </div>
		
 <iframe width='100%' height='450px' frameborder='0' style='border:0'
src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2290.131178500172!2d-1.620138905248365!3d54.97079869376171!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487e70b54ac2b863%3A0x455afd7d716b531f!2s5+Charlotte+Square%2C+Newcastle+upon+Tyne%2C+Tyne+and+Wear+NE1+4XF!5e0!3m2!1sen!2suk!4v1449423187821'></iframe>
	
    <div class='container'>
        <div class='row'>
            <div class='span12'>
                <div class='headline'>
                    <h2>Get in touch</h2>
                </div>
            </div>
        </div>

        <div class='row'>
            <div class='span8'>
                <h5 class='text-uppercase'>Send us a message</h5>
                <form action='scripts/script_contactUs.php' id='contact-form' method='post' name='contact-form' novalidate='novalidate'>
                    <fieldset>
                        <div id='formstatus'></div>
                        <p><input class='span12' id='name' name='name' placeholder='Name*' type='text' value=''></p>
                        <p><input class='span12' id='email' name='email' placeholder='Email*' type='text' value=''></p>
                        <p><input class='span12' id='phonenumber' name='phonenumber' placeholder='Phone Number*' type='text' value=''></p>
                        <p>
							<textarea class='span12' cols='25' id='message' name='message' placeholder='Message*' rows='7'>
							</textarea>
						</p>
                        <p class='last'><input class='btn' id='submit' name='submit' type='submit' value='Submit'></p>
                    </fieldset>
                </form>
            </div>
            <div class='span4'>
                <div class='widget ewf_widget_contact_info'>
                    <h5 class='widget-title'>Contact Info</h5>
                        <ul>
							<li><b>Dragon Utilities</b></li>
							<li>5 Charlotte Square<br/>
							Newcastle Upon Tyne<br/> 
							NE1 4XF<br>
							</li>
							<li>0191 261 0760</li>
							<li><a href='mailto:enquiries@dragonutilities.com'>enquiries@dragonutilities.com</a></li>
							<li><a href='#'>www.dragonutilities.com</a></li>
                        </ul>
                </div>
            </div>
        </div>
    </div>
";

require_once("includes/footer.php");

?>
