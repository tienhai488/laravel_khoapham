<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GroupsModel extends Model
{
    protected $table = 'groups';

    public function user()
    {
        return $this->hasMany(UsersModel::class,'group_id','id');
    }
    
    public function getAllGroups(){
        return DB::table($this->table)->orderBy('create_at','desc')->get();
    }
}