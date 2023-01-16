<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;

// Route::get('unicode',function(){
//     return view('form');
// });

// Route::post('unicode',function(){
//     return 'Day la post cua unicode';
// });

// Route::put('unicode',function(){
//     return 'Day la put cua unicode';
// });

// Route::delete('unicode',function(){
//     return 'Day la delete cua unicode';
// });

// Route::patch('unicode',function(){
//     return 'Day la patch cua unicode';
// });

// // Route::redirect();

// // Route::view();

// Route::prefix('admin')->group(function(){
//     Route::prefix()->group();
// });

// Route::get('/','App\Http\Controllers\HomeController@index')->middleware('checkpermission')->name('home');//goi den phuong thuc index trong HomeController
// Route::get('/tin-tuc','App\Http\Controllers\HomeController@news')->name('news');

// Route::get('/danh-muc/{id}',[HomeController::class,'getCategories'])->name('danhmuc');//goi lavarel moi nhat

// Route::prefix('admin')->group(function(){
//     Route::get('show-form',function(){
//         return view('form');
//     });

//     Route::get('tin-tuc/{id?}/{slug?}.html',function($id=null,$slug=null){
//         $content = "Id : $id <br/>";
//         $content.="Slug : $slug";
//         return $content;
//     })->where('id','\d+')->where('slug','.+')->name('admin.tintuc');
// });

// Client Routes
Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('san-pham',[ProductsController::class,'index'])->name('product');

Route::get('them-san-pham',[ProductsController::class,'addProduct'])->name('addProduct');

Route::post('them-san-pham',[ProductsController::class,'handleAddProduct'])->name('handleAddProduct');


Route::prefix('user')->group(function(){
    Route::get('/',[UsersController::class,'index']);
});