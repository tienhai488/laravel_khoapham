<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersModel extends Model
{
    protected $table = 'users';
    
    public function getAllUsers($filters,$keyword = '',$sortArr = [],$perPage = null){
        // DB::enableQueryLog();
        $users = DB::table($this->table)->join('groups','groups.id','users.group_id')->select('users.*','groups.fullname as name_group');
        if(!empty($filters)){
            $users = $users->where($filters);
        }

        if(!empty($keyword)){
            $users = $users->where(function ($query) use($keyword){
                $query->orWhere('users.fullname','like',"%$keyword%");
                $query->orWhere('users.email','like',"%$keyword%");
            });
        }

        $sortBy = 'create_at';
        $sortType = 'desc';
        if(!empty($sortArr) && is_array($sortArr)){
            if(!empty($sortArr['sortBy'])&&!empty($sortArr['sortType'])){
                $sortBy = $sortArr['sortBy']; 
                $sortType = $sortArr['sortType']; 
            }
        }
        $users = $users->orderBy("$sortBy","$sortType");

        if(!empty($perPage)){
            $users = $users->paginate($perPage)->withQueryString();
        }else{
            $users = $users->get();
        }

        return $users;
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

    public function statementUser($sql){
        return DB::statement($sql);
    }

    public function learnQueryBuilder(){
        // where(funtion($query) use($id){
        //     $query->where()->orWhere()
        // })
        // ->select(DB::raw('count(*) as sl,fullname,email'))
        // ->where() 
        // 
        // Dem so ban ghi 
        // $count = DB::table('users')->count();
    }
}