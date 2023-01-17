<?php

use App\Models\GroupsModel;

function isUppercase($value,$message,$fail){
    if($value!=mb_strtoupper($value,'UTF-8')){
        $fail($message);
    }
}

function getAllGroups(){
    $groups = new GroupsModel();
    return $groups->getAllGroups();
}