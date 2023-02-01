<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;

    protected $redirectTo = RouteServiceProvider::ADMIN;

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function rules()
    {
        return [
            'password' => 'required|current_password:web',
        ];
    }

    protected function validationErrorMessages()
    {
        return [
            'password.required'=>'Vui lòng nhập mật khẩu!',
            'password.current_password'=>'Mật khẩu vừa nhập không chính xác!',
        ];
    }

    public function confirm(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $this->resetPasswordConfirmationTimeout($request);

        // // Xử lý gửi email
        // Mail::send([],[],function ($message){
        //     $message->to('tienhai488@gmail.com')
        //     ->subject('Xac thuc mat khau')
        //     ->getBody('Ban da xac thuc mat khau thanh cong!');
        // });


        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }
}