<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Uppercase implements Rule
{
    public function __construct()
    {
        //
    }

    // xử lý logic để validate
    public function passes($attribute, $value)
    {
        return $value === mb_strtoupper($value,'UTF-8');
    }

    public function message()
    {
        return ':attribute không hợp lệ!';
    }
}