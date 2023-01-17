<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersModel extends Model
{
    protected $table = 'account_user';
    
    public function getAllUsers(){
        return DB::select("select * from $this->table order by create_at desc");
    }

    public function getUserDetail($id){
        return DB::select("select * from $this->table where id = $id");
    }

    public function insertUser($data){
        return DB::insert("insert into $this->table (fullname,email,create_at) values (?,?,?)",$data);
    }

    public function updateUser($data,$id){
        return DB::update("update $this->table set fullname = ?,email = ?,update_at = ? WHERE id = $id", $data);
    }

    public function deleteUser($id){
        return DB::delete("DELETE FROM $this->table WHERE id=$id");
    }
}