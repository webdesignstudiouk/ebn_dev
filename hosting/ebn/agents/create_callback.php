<?php
$type="agent";
$title="Create Callback";
require_once("../models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}
$userId = $_GET['id'];

if(!empty($_POST))
{
$description = trim($_POST["description"]);
$date = trim($_POST["date"]);

$link = mysqli_connect($db_host ,$db_user , $db_pass , $db_name );
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}
mysqli_query($link,"INSERT INTO uc_callbacks (user_id, description, date)
VALUES ('" .$userId. "', '" .$description. "', '" .$date. "')");

mysqli_close($link);

header('Location: ../agents/callbacks.php?id='. ${userId});

}
require_once("../includes/header.php");


navbaruser($userId, "Call Backs");
echo $before_body;
echo resultBlock($errors,$successes);

echo "
<div class='col-sm-12 '>

<form name='adminUser' class='form-horizontal user_form' action='".$_SERVER['PHP_SELF']."?id=${userId}' method='post'>
<div class='panel panel-default' style=''>
<div class='panel-heading' style='background-color:#09f; padding:0px!important;'>

<div style='width:100%;'><h4 class='panel-title pull-left' style='padding-left:10px; width:700px; text-align:left; color:#fff;'>Create Callback</h4></div>
</div>

<div class='panel-body'>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Notes:</label>
<div class='col-sm-10 editable'>
<textarea name='description' id='reg_textarea' cols='10' rows='3' class='form-control'></textarea>
</div>
</div>

<div class='form-group' style='margin-bottom:15px;'>
<label class='col-sm-2 control-label'>Callback Date:</label>
<div class='col-sm-10 editable'>
<input name='date' id='date' cols='10' rows='3' class='form-control'></input>
</div>
</div>

<button class='btn btn-primary btn-lg openmodal' style='float:right;'>Create Callback</button>

</div>
</div></div>
</div>
</div>
</div>


</form>
>";
echo $after_body;
require_once("../includes/footer.php");
echo $after_footer;
require_once("../includes/sidebar.php");
?>