<?php
$type = "warning";
$icon = "plus";

$prospect = \App\Models\Prospects::withTrashed()->find($notification->data['requested_prospect']);
$message = "requested a prospect";
if($prospect){
	$content = "<ul>";
	if($prospect->trashed()){
		$content .= "<li>" . $prospect->id . ' - ' . $prospect->company . "</li>";
	}else{
		$content .= "<li>" . $prospect->id . ' - ' . $prospect->company . "
			<span style='float:right; margin-top: -5px;'><a class='btn btn-success' href='".route('prospects.edit', $prospect->id)."'>View account</a></span>
		</li>";
	}
	$content .= "</ul>";
}
