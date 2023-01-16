<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index(){
        $title = "Quản lý người dùng";
        $users = DB::select("select * from users order by created_at desc");
        return view('clients/users/list',compact(['title','users']));
    }
}