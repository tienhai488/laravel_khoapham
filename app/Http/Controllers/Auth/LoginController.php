<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::ADMIN;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect(route('login'));
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string|min:8',
        ],[
            $this->username().'.required'=>'Vui lòng nhập vào tên đăng nhập!',
            $this->username().'.string'=>'Dữ liệu nhập vào không hợp lệ!',
            'password.required'=>'Vui lòng nhập vào mật khẩu!',
            'password.string'=>'Mật khẩu nhập vào không hợp lệ!',
            'password.min'=>'Mật khẩu ít nhất :min kí tự!',
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => ['Tên đăng nhập hoặc mật khẩu không đúng!'],
        ]);
    }

    public function username(){
        return 'username';
    }

    protected function credentials(Request $request)
    {
        if(filter_var($request->username,FILTER_VALIDATE_EMAIL)){
            $fieldDb = 'email';
        }else{
            $fieldDb = 'username';
        }

        $dataArr = [
            $fieldDb => $request->username,
            'password' => $request->password,
        ];

        return $dataArr;
    }
}