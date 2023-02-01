<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return '<h1>Doctor page</h1>';
    }
    public function login()
    {
        if(Auth::guard('doctor')->check()){
            echo 'Dang nhap thanh cong!';
            $info = Auth::guard('doctor')->user();
            dd($info);
        }
        return view('doctor.auth.login');
    }

    public function postLogin(Request $request)
    {
        $dataLogin = $request->except(['_token']);
        if (isDoctorActive($request->email)) {
            if (Auth::guard('doctor')->attempt($dataLogin)) {
                return redirect(RouteServiceProvider::DOCTOR);
            }
            return back()->with('msg','Đăng nhập không thành công! Vui lòng thử lại!');
        }
        return back()->with('msg','Tài khoản không tồn tại hoặc chưa kích hoạt!');
    }
}