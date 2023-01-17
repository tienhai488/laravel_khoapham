<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;

// Client Routes
Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('san-pham',[ProductsController::class,'index'])->name('product');

Route::get('them-san-pham',[ProductsController::class,'addProduct'])->name('addProduct');

Route::post('them-san-pham',[ProductsController::class,'handleAddProduct'])->name('handleAddProduct');


Route::prefix('user')->name('user.')->group(function(){
    Route::get('/',[UsersController::class,'index'])->name('index');
    Route::get('add',[UsersController::class,'add'])->name('add');
    Route::post('add',[UsersController::class,'postAdd'])->name('post-add');
});