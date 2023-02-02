<?php

namespace App\Http\Controllers\Doctor\Auth;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(){
        return view('doctor.auth.forgot');
    }

    use SendsPasswordResetEmails;

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $this->credentials($request)
        );

        return $response == Password::RESET_LINK_SENT
                    ? $this->sendResetLinkResponse($request, $response)
                    : $this->sendResetLinkFailedResponse($request, $response);
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email'],[
            'email.required'=>'Vui lòng nhập vào email!',
            'email.email'=>'Email không hợp lệ'
        ]);
    }

    public function broker()
    {
        // ten bang doctors duoc cau hinh auth.php phan passwords
        return Password::broker('doctors');
    }

    

}