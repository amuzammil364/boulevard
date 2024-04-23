<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "role_id" => 1,
            "first_name" => "Divi",
            "last_name" => "Stack",
            "email" => "alpha@divistack.com",
            "password" => Hash::make("Dev@2020!"),
            "phone" => 23232323
        ]);
    }
}
