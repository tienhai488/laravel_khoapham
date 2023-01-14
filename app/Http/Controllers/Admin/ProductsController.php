<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // Xem danh sach san pham GET
    public function index()
    {
        $title = 'Product Admin';
        return view('clients/product',compact(['title']));
    }

    // Them san pham GET
    public function create()
    {
        //
    }

    // Xu ly them san pham POST 
    public function store(Request $request)
    {
        //
    }

    // Xem chi tiet mot  san pham GET
    public function show($id)
    {
        //
    }


    // Chinh sua san pham GET
    public function edit($id)
    {
        //
    }

    // Xu ly chinh sua san pham POST 
    public function update(Request $request, $id)
    {
        //
    }

    // Xu ly xoa san pham 
    public function destroy($id)
    {
        //
    }
}