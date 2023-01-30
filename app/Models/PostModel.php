<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $primaryKey = 'id';

    protected $attributes = [
        'status' => 0,
    ];

    /**
     * Them 
     * create($data)
     * 
     * insert($data)
     * 
     * $post = new Post;
     * $post->save()
     * 
     * firstOrCreate($attribute,$data)
     * 
     * Sua 
     * $post = Post::find($id)
     * $post->update($data)
     * 
     * updateOrCreate()
     * 
     * Xoa du lieu 
     * Post::destroy($id)
     * 
     * Post::destroy($id1,$id2)
     * 
     * Post::destroy([$id1,$id2])
     */
}