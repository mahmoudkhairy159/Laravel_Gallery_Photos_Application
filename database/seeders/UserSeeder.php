<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Mahmoud Khairy',
            'email' => 'mahmoudkhairy159@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // You can set a default password here
            'remember_token' => Str::random(10),
        ];
        $user =   User::create($data);


    }
}
