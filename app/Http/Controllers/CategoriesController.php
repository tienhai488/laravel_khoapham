<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct(){

    }

    // xem danh sach danh muc 
    public function index(){
        return view('clients/categories/list');
    }
    
    // cap nhap danh muc GET 
    public function updateCategory($id){
        return view('clients/categories/update');
    }
    
    // cap nhap danh muc POST 
    public function handleUpdateCategory($id){
        
    }
   
    // them danh muc POST 
    public function handleAddCategory(){
        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
    }
    
    // them danh muc  GET 
    public function addCategory(){
        return view('clients/categories/add');
    }

    // xoa danh muc DELETE
    public function deleteCategory($id){

    }
}