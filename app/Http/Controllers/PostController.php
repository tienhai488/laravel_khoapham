<?php

namespace App\Http\Controllers;

use App\Models\PostModel;

class PostController extends Controller
{
    public function index(){
        $posts = PostModel::find(1);
        dd($posts);
    }
}