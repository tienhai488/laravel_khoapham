<?php

namespace App\Http\Controllers\Doctor\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function handleResetPassword(Request $request,$token){
        return $request->email;
    }

    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::DOCTOR;

    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required','min:8', 'confirmed'],
        ];
    }

    protected function validationErrorMessages()
    {
        return [
            'token.required'=>'Token không tồn tại!(bs)',
            'email.required'=>'Vui lòng nhập email!(bs)',
            'email.email'=>'Email không hợp lệ!(bs)',
            'password.required'=>'Vui lòng nhập mật khẩu!(bs)',
            'password.min'=>'Mật khẩu ít nhất :min kí tự!(bs)',
            'password.confirmed'=>'Mật khẩu nhập lại không trùng khớp!(bs)',
        ];
    }

    public function showResetForm(Request $request)
    {
        $token = $request->route()->parameter('token');

        return view('doctor.auth.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function broker()
    {
        return Password::broker('doctors');
    }

    protected function guard()
    {
        return Auth::guard('doctor');
    }
}