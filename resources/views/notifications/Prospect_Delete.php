<?php
    $type = "danger";
    $icon = "trash";
    if(isset($notification->data['deleted_prospects']) && count($notification->data['deleted_prospects']) > 1){
        $message = "deleted ". count($notification->data['deleted_prospects'])." prospects";
        $content = "<ul>";

	    foreach ( $notification->data['deleted_prospects'] as $deleted_prospect ) {
		    $content.="<li>".$deleted_prospect.' - '.\App\Models\Prospects::withTrashed()->find($deleted_prospect)->company."</li>";
        }
	    $content .= "</ul>";
    }else{
        $prospect = \App\Models\Prospects::withTrashed()->find($notification->data['deleted_prospects'][0]);
        if($prospect){
            $message = "deleted a prospect: ".$prospect->company;
        }else{
            $message = "deleted a prospect";
        }
    }


