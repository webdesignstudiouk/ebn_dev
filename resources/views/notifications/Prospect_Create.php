<?php
$type = "success";
$icon = "plus";

$prospect = \App\Models\Prospects::withTrashed()->find($notification->data['created_prospect']);

if($prospect){
	$message = "created a prospect: ".$prospect->company;
}else{
	$message = "created a prospect";
}


