<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
                [
                'user_name' => 'admin',
                'email' => 'touseefakram3@gmail.com',
                'role' => 'admin',
                'password' => '123',
                'created_at' => now(),
                ]
        );
    }
}
