<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        $title = 'Product';
        return view('clients/product',compact(['title']));
    }

    public function addProduct(){
        $title = "Thêm sản phẩm";
        return view('clients/add',compact(['title']));
    }

    public function handleAddProduct(Request $request){
        $rules = [
            'product_name' => 'required|min:6',
            'product_price' => 'required|integer',
        ];

        $message = [
            'product_name.required'=>"Tên sản phẩm không được để trống!",
            'product_name.min'=>"Tên sản phẩm có ít nhất :min ký tự!",
            'product_price.required'=>"Giá sản phẩm không được để trống!",
            'product_price.integer'=>"Giá sản phẩm không hợp lệ!",
        ];

        // :min lấy giá trị đặt làm min
        // :attribute lây giá tri name của form input

        $request->validate($rules,$message);
    }
}