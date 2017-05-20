<?php
require_once("../models/config.php");
$type = "user";
$userId = $_GET['id'];
$sid = $_GET['sid'];
$title = "Create Meter";
$sites = fetchusersites($userId);
if (!securePage($_SERVER['PHP_SELF'])){die();}

require_once("../includes/header.php");
navbaruser($userId, "");


echo $before_body;
echo resultBlock($errors,$successes);

echo "<form name='adminUser' class='form-horizontal user_form' action='meterchoice.php' method='post'>";
 
if ($sid == '') {
echo "<div class='form-group'>	
<label class='col-sm-2 control-label'>Site The Meter Is For:</label>
<div class='col-sm-10 editable'>
<select id='site_id' name='site_id' class='form-control'>";
foreach ($sites as $v1) {
echo "<option value='", $v1['id'], "'>";
echo $v1['name'];
echo "</option>";
}
echo "</select>
</div>
</div>";
}else{
echo "<input type='hidden' class='form-control' name='site_id' value='", $sid, "'>";
}
echo "
<input type='hidden' class='form-control' name='user_id' value='", $userId, "'>

<div class='form-group'>	
<label class='col-sm-2 control-label'>Type Of Meter:</label>
<div class='col-sm-10 editable'>
<select id='mtype' name='mtype' class='form-control'>
<option value='electric'>Electric</option>
<option value='gas'>Gas</option>
</select>
</div>
</div>

<br/>
<button class='btn btn-primary btn-lg openmodal' style='float:right;'>Create Meter</button>


</form>
</div>";

echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>
 