<?php

if(!empty($_POST))
{
$userid = trim($_POST["user_id"]);
$siteid = trim($_POST["site_id"]);
$metertype = trim($_POST["mtype"]);

header('Location: create_' . $metertype . '_meter.php?id='. $userid . '&sid='. $siteid);
}

























?>