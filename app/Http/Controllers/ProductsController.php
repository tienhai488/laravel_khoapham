<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(){
        $title = 'Product';
        return view('clients/product',compact(['title']));
    }
}