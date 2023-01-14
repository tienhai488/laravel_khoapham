<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct(){

    }

    // xem danh sach danh muc 
    public function index(Request $request){
        /**
         * all -> lay tat ca params
         * path -> lay path dang truy cap 
         * url -> lay ca duong dan
         * fullUrl -> lay ca duong dan va params
         * is -> check xem co dang truy cap vao mot path nao do 
         * method -> lay phuong thuoc hien tai cua trang web
         * ip -> lay ip cua trang web
         * server -> giong nhu $_SERVER
         * header -> thong tin header 
         * input -> lay ra tat ca value input hoac params tren duong dan name.0.id 
         * name -> $request->id -> tro den id cua params tren duong dan 
         * 
         * --helper()
         * request()
         * request($key,$default)-> neu lay $key params khong co value thi lay value = $default
         * 
         * $request->query() -> chi lay tren query string 
         * has() -> kiem tra input co ton tai hay khong -> $request->has('name')
         * flash() -> session flash
         * old($key,$default) -> nhan lai data cua session flash
         * file() -> xu ly viec upload file file($key) lay thong tin cua file 
         * hasFile($key) -> kiem tra file da duoc chon chua 
         * isValid() -> kiem tra xem file co upload thanh cong chua 
         * extension() lay duoi cua file 
         * store() -> di chuyen file tu file tam tren server chuyeen vao local(trong thu muc storage/app/) -> store('images','local') -> images la thu muc duoc chi dinh de luu
         * storeAs() -> doi ten thu muc luu tru -> storeAs('images','img')
         * 
         */
        $data = $request->name;
        dd($data);
        // echo $request->url();
        // echo '<br>';
        // echo "le tien hai";
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

    public function handleFile(Request $request){

    }
}