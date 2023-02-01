<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::HOME;

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
            'token.required'=>'Token không tồn tại!',
            'email.required'=>'Vui lòng nhập email!',
            'email.email'=>'Email không hợp lệ!',
            'password.required'=>'Vui lòng nhập mật khẩu!',
            'password.min'=>'Mật khẩu ít nhất :min kí tự!',
            'password.confirmed'=>'Mật khẩu nhập lại không trùng khớp!',
        ];
    }
}