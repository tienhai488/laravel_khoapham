<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return 'HomeController.index';
    }
    
    public function news(){
        return 'HomeController.news';
    }

    public function getCategories($id){
        return "Danh muc : $id";
    }
}