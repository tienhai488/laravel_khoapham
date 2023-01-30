<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneModel extends Model
{
    use HasFactory;

    protected $table = 'phone';

    public function user()
    {
        return $this->belongsTo(UsersModel::class,'user_id','id');
    }
}