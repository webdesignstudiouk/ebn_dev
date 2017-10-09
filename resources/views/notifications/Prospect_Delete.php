<?php
    $type = "danger";
    $icon = "trash";
    if(isset($notification->data['deleted_prospects']) && count($notification->data['deleted_prospects']) > 1){
        $message = "deleted ". count($notification->data['deleted_prospects'])." prospects";
    }else{
        $prospect = \App\Models\Prospects::withTrashed()->find($notification->data['deleted_prospects'][0]);
        if($prospect){
            $message = "deleted a prospect: ".$prospect->company;
        }else{
            $message = "deleted a prospect";
        }
    }


