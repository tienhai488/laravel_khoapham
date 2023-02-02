<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index(){
        return '<h1>Trang chu post</h1>';
    }

    public function add(){
        return '<h1>Them bai post</h1>';
    }

    public function edit($id){
        $post = Post::find($id);
        if(empty($post)){
            return 'Khong ton tai bai viet ';
        }
        if (Gate::allows('post.edit', $post)) {
            return 'Cho phep them bai viet';
        }
        if (Gate::denies('post.edit', $post)) {
            return 'Khong cho phep them bai viet';
        }
        return "<h1>Chinh sua bai viet $id</h1>";
    }
}