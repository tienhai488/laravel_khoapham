<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Doctor\Auth\LoginController;
use App\Http\Controllers\Doctor\IndexController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Client Routes
Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('san-pham',[ProductsController::class,'index'])->name('product');

Route::get('them-san-pham',[ProductsController::class,'addProduct'])->name('addProduct');

Route::post('them-san-pham',[ProductsController::class,'handleAddProduct'])->name('handleAddProduct');


Route::prefix('user')->name('user.')->group(function(){
    Route::get('/',[UsersController::class,'index'])->name('index');

    Route::get('add',[UsersController::class,'add'])->name('add');

    Route::post('add',[UsersController::class,'postAdd'])->name('post-add');

    Route::get('edit/{id}',[UsersController::class,'getEdit'])->name('get-edit');
    
    Route::post('update/',[UsersController::class,'postEdit'])->name('post-edit');

    Route::get('delete/{id}',[UsersController::class,'delete'])->name('delete');

    Route::get('get-phone',[UsersController::class,'relations'])->name('get-phone');
});

Route::prefix('posts')->name('posts.')->group(function(){
    Route::get('/',[PostController::class,'index'])->name('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function(){
    Route::get('/',[AdminController::class,'index']);

    // Route::get('/products')
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

    Route::post('logout',function(){
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.login');
    })->middleware('auth:doctor')->name('logout');
});