<?php //just display the privacy policy
/* ====================================================================================================================== */
/* NoNonsense Forum v25 © Copyright (CC-BY) Kroc Camen 2010-2013
   licenced under Creative Commons Attribution 3.0 <creativecommons.org/licenses/by/3.0/deed.en_GB>
   you may do whatever you want to this code as long as you give credit to Kroc Camen, <camendesign.com>
*/

//bootstrap the forum; you should read that file first
require_once './start.php';

$template = prepareTemplate (THEME_ROOT.'privacy.html', '/privacy.html');

theme_custom ($template);
exit ($template);

?>