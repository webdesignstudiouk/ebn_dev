<?php
$type="admin";
$title="Uploads"; 
require_once("../models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$userData = fetchAllUsers(); //Fetch information for all users
require_once("../includes/header.php");

echo $navbar_admin;
echo $before_body;
echo resultBlock($errors,$successes);

echo "<style>
.restricted{ overflow-y: hidden;}
</style>
<center><iframe src='../uploads/view.php' width='95%' id='iframe1' height='1300' marginheight='0' frameborder='0' class='restricted' scrolling=''></iframe></center>

";

echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>