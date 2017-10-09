<?php
$type = "success";
$icon = "plus";
$callback = \App\Models\ProspectsCallbacks::withTrashed()->find($notification->data['created_callback']);
if($callback) {
	$prospect = \App\Models\Prospects::withTrashed()->find( $callback->prospect_id );
	$content  = '';
	if ( $prospect ) {
		$message = "created a callback for <strong>" . $prospect->company . '</strong>';
		$content .= "<blockquote>" . $callback->note . "</blockquote>";
		$content .= "<ul>";
		$content .= "<li>Callback Date:  " . \Carbon\Carbon::createFromFormat( 'Y-m-d', $callback->callbackDate )->format( 'd/m/Y' ) . "</li>";
		$content .= "<li>Callback Time:  " . $callback->callbackTime . "</li>";
		$content .= "</ul>";
	} else {
		$message = "created a callback";
	}
}else{
	$skip = true;
}
