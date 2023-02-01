<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorsSeeder extends Seeder
{
    public function run()
    {
        DB::table('doctors')->insert([
            'name'=>'TienHai',
            'email'=>'tienhai@gmail.com',
            'password'=>Hash::make('12345678'),
            'is_active'=>1,
        ]);
    }
}