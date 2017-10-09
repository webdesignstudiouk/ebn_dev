<?php
$type = "warning";
$icon = "plus";

$prospect = \App\Models\Prospects::withTrashed()->find($notification->data['requested_prospect']);
if($prospect){
	$message = "requested a prospect: ".$prospect->company;
}else{
	$message = "requested a prospect";
}


