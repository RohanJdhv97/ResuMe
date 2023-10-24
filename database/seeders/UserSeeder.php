<?php

namespace Database\Seeders;

use App\Models\Role;
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
        User::insert([
            'first_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '8861681649',
            'password' => Hash::make('test1234'),
            
        ]);
    }
}
