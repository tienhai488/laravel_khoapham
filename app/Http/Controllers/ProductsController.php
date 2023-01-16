<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Validator;
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

    public function handleAddProduct(ProductRequest $request){
        $rules = [
            'product_name' => 'required|min:6',
            'product_price' => 'required|integer',
        ];

        $messages = [
            'product_name.required'=>":attribute không được để trống!",
            'product_name.min'=>":attribute có ít nhất :min ký tự!",
            'product_price.required'=>":attribute không được để trống!",
            'product_price.integer'=>":attribute không hợp lệ!",
        ];

        $attributes = [
            'product_name'=>'Tên sản phẩm',
            'product_price'=>'Giá sản phẩm',
        ];

        // $validator = Validator::make($request->all(),$rules,$messages,$attributes);

        // $request->validate($rules,$messages);

        return response()->json(['status'=>'success']);
    }
}