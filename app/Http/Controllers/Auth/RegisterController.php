<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo;

    public function __construct()
    {
        $this->middleware('guest');
        $this->redirectTo = route('register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username'=>['required','string','min:5','max:20'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required','same:password'],
        ],[
            'required'=>':attribute không được để trống!',
            'string'=>':attribute nhập vào không hợp lệ!',
            'email'=>':attribute không hợp lệ!',
            'max'=>':attribute nhập không quá :max kí tự!',
            'min'=>':attribute nhập ít nhất :min kí tự!',
            'unique'=>':attribute đã tồn tại!',
            'same'=>':attribute không trùng khớp!'
        ],[
            'name'=>'Họ tên',
            'email'=>'Email',
            'username'=>'Tên đăng nhập',
            'password'=>'Mật khẩu',
            'password_confirmation'=>'Mật khẩu nhập lại',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath(route('register')))->with('msg','Tài khoản đã được tạo! Bạn có thể truy cập ngay bây giờ!');
    }
}