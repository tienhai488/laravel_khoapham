<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;

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
Route::prefix('categories')->group(function(){
    // Danh sach chuyen muc
    Route::get('/',[CategoriesController::class,'index'])->name('categories.list');

    // Lay chi tiet mot chuyen muc de sua
    Route::get('edit/{id}',[CategoriesController::class,'updateCategory'])->name('categories.update');

    // Xu ly sua chuyen muc duoc chi dinh
    Route::post('edit/{id}',[CategoriesController::class,'handleUpdateCategory']);

    // Hien thi form them du lieu
    Route::get('add',[CategoriesController::class,'addCategory'])->name('categories.add');

    // Xu ly viec them du lieu 
    Route::post('add',[CategoriesController::class,'handleAddCategory']);

    //Xu ly xoa chuyen muc 
    Route::delete('delete/{id}',[CategoriesController::class,'deleteCategory'])->name('categories.delete');

});
Route::prefix('admin')->group(function(){
    Route::resource('product', ProductsController::class);
});