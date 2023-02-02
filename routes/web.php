<?php

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Doctor\Auth\ForgotPasswordController;
use App\Http\Controllers\Doctor\Auth\LoginController;
use App\Http\Controllers\Doctor\Auth\ResetPasswordController;
use App\Http\Controllers\Doctor\IndexController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function(){
    Route::get('/',[AdminController::class,'index']);

    Route::prefix('post')->name('post.')->group(function(){
        Route::get('/',[AdminPostController::class,'index'])->name('index');

        Route::get('/add',[AdminPostController::class,'add'])->name('add');

        Route::get('/edit/{id}',[AdminPostController::class,'edit'])->name('edit');
    });
});

// Xác thực email
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

// Gửi email xác thực
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Hành động gửi lại email xác thực
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

// Doctor
Route::prefix('doctor')->name('doctor.')->group(function(){
    Route::get('/',[IndexController::class,'index'])->name('index')->middleware('auth:doctor');

    Route::get('login',[LoginController::class,'login'])->name('login')->middleware('guest:doctor');

    Route::post('login',[LoginController::class,'postLogin'])->name('post-login')->middleware('guest:doctor');

    Route::get('forgot-password',[ForgotPasswordController::class,'forgotPassword'])->name('forgot-password')->middleware('guest:doctor');

    Route::post('forgot-password',[ForgotPasswordController::class,'sendResetLinkEmail'])->middleware('guest:doctor');

    Route::get('reset-password/{token}',[ResetPasswordController::class,'showResetForm'])->middleware('guest:doctor')->name('reset-password');

    Route::post('reset-password',[ResetPasswordController::class,'reset'])->middleware('guest:doctor')->name('update-password');

    Route::post('logout',function(){
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.login');
    })->middleware('auth:doctor')->name('logout');
});