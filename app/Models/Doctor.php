<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Doctor extends Authenticatable
{
    use HasFactory,HasApiTokens, HasFactory, Notifiable;

    protected $table = 'doctors';

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
    ];
}