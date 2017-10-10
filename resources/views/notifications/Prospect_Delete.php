<?php
    $type = "danger";
    $icon = "trash";
    if(isset($notification->data['deleted_prospects']) && count($notification->data['deleted_prospects']) > 1){
        $message = "deleted ". count($notification->data['deleted_prospects'])." prospects";
    }else{
	    $message = "deleted a prospect";
    }

    if(isset($notification->data['deleted_prospects']) && count($notification->data['deleted_prospects']) > 0) {
	    $content = "<ul>";
	    foreach ( $notification->data['deleted_prospects'] as $deleted_prospect ) {
		    $content .= "<li>" . $deleted_prospect . ' - ' . \App\Models\Prospects::withTrashed()->find( $deleted_prospect )->company . "</li>";
	    }
	    $content .= "</ul>";
    }

