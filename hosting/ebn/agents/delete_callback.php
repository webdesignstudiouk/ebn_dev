<?php
require_once("../models/config.php");
if (!securePage($_SERVER['PHP_SELF'])){die();}

if($_SERVER['REQUEST_METHOD']=="POST")
{
$callbackId = $_POST["callbackId"];
$userId = $_POST["userId"];

$link = mysqli_connect($db_host ,$db_user , $db_pass , $db_name );
if (mysqli_connect_errno()) {
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}

mysqli_query($link,"DELETE FROM uc_callbacks WHERE id='" . $callbackId  . "'");

mysqli_close($link);

header('Location: callbacks.php?id=' . $userId);
}

?>

