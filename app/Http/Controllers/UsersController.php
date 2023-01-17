<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $__usersModel;
    
    public function __construct()
    {
        $this->__usersModel = new UsersModel();
    }

    public function index(){
        $title = "Quản lý người dùng";
        $userList = $this->__usersModel->getAllUsers();
        return view('clients/users/list',compact(['title','userList']));
    }

    public function add(){
        $title = "Thêm người dùng";
        return view('clients/users/add',compact(['title']));
    }

    public function postAdd(Request $request){
        $request->validate([
            'fullname'=>'required|min:5',
            'email'=>'required|email|unique:account_user,email'
        ],[
            'fullname.required'=>"Họ tên không được để trống!",
            'fullname.min'=>"Họ tên ít nhất :min kí tự!",
            'email.required'=>"Email không được để trống!",
            'email.email'=>"Email không hợp lệ!",
            'email.unique'=>"Email đã tồn tại!",
        ]);

        $dataInsert = [
            request()->fullname,
            request()->email,
            date('Y-m-d H:i:s')
        ];

        $this->__usersModel->insertUser($dataInsert);

        return redirect(route('user.index'))->with('msg','Thêm người dùng thành công!');
    }


}