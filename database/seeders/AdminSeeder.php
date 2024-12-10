<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::updateOrCreate([ 'email'=>'itrove@gmail.com'],[
        'first_name'=>'Innovation',
        'last_name'=>'Trave',
        'email'=>'itrove@gmail.com',
        'password'=>Hash::make('123456789'),
        'status'=>true,
        'is_admin'=>true
       ]);
    }
}
