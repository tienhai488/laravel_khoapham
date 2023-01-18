<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $__usersModel;
    const _PER_PAGE = 3;
    
    public function __construct()
    {
        $this->__usersModel = new UsersModel();
    }

    public function index(Request $request){
        $filters = [];
        if(!empty($request->status)){
            if($request->status=='kichhoat'){
                $filters[] = ['users.status',1];
            }else{
                $filters[] = ['users.status',0];
            }
        }

        if(!empty($request->group_id)){
            $filters[] = ['users.group_id',$request->group_id];
        }
        
        $title = "Quản lý người dùng";

        $sortType = $request->sortType;
        $sortBy = $request->sortBy;
        
        $allowSort = ['asc','desc'];
        
        if(empty($sortType)||!in_array($sortType,$allowSort)){
            $sortType = 'asc';
            $sortTypeOld =  $sortType;
        }else{
            $sortType = $sortType == 'desc' ? 'asc' : 'desc';
            $sortTypeOld = $sortType == 'desc' ? 'asc' : 'desc';
           
        }

        $sortArr = [
            'sortBy'=>$sortBy,
            'sortType'=>$sortTypeOld
        ];

        $userList = $this->__usersModel->getAllUsers($filters,$request->keyword,$sortArr,self::_PER_PAGE);
    
        return view('clients/users/list',compact(['title','userList','sortBy','sortType','sortTypeOld']));
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

    public function getEdit(Request $request,$id){
        if(!empty($id)){
            $userDetail = $this->__usersModel->getUserDetail($id);
            if(!empty($userDetail)){
                $title = 'Cập nhập người dùng';
                $userDetail = $userDetail[0];
                $request->session()->put('id', $id);
                return view('clients.users.update',compact(['title','userDetail']));
            }else{
                return redirect(route('user.index'))->with('msg','Không tồn tại người dùng!');
            }
        }else{
            return redirect(route('user.index'))->with('msg','Đường liên kết không tồn tại!');
        }
    }

    public function postEdit(Request $request){
        $id = session('id');

        $request->validate([
            'fullname'=>'required|min:5',
            'email'=>'required|email|unique:account_user,email,'.$id,
        ],[
            'fullname.required'=>"Họ tên không được để trống!",
            'fullname.min'=>"Họ tên ít nhất :min kí tự!",
            'email.required'=>"Email không được để trống!",
            'email.email'=>"Email không hợp lệ!",
            'email.unique'=>"Email đã tồn tại!",
        ]);

        $dataUpdate = [
            request()->fullname,
            request()->email,
            date('Y-m-d H:i:s')
        ];

        $this->__usersModel->updateUser($dataUpdate,$id);

        return redirect(route('user.index'))->with('msg','Cập nhập người dùng thành công!');
    }

    public function delete($id){
        if(!empty($id)){
            $userDetail = $this->__usersModel->getUserDetail($id);
            if(!empty($userDetail)){
                $this->__usersModel->deleteUser($id);
                return redirect(route('user.index'))->with('msg','Xóa người dùng thành công!');
            }else{
                return redirect(route('user.index'))->with('msg','Không tồn tại người dùng!');
            }
        }else{
            return redirect(route('user.index'))->with('msg','Đường liên kết không tồn tại!');
        }
    }


}