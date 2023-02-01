<?php

use App\Models\Doctor;
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

function isDoctorActive($email){
    return Doctor::where('email',$email)->where('is_active',1)->count() > 0;
}