<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $title = "Trang chủ";
        return view('clients/home',compact(['title']));
        // $title = "Laravel";
        // $content = "Hoc lap trinh Laravel";
        // return view('clients/home/index',compact(['title','content']));
        /**
         * Co ba loai truyen data 
         * - Truyen mang ['title'=>$title]
         * - Truyen bang compact nhu tren 
         * - Truyen bang with():  view()->with(['title'=>$title]) 
         * */        
    }
    
    public function news(){
        return 'HomeController.news';
    }

    public function getCategories($id){
        return "Danh muc : $id";
    }
}