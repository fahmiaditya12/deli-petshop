<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@petshop.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'kasir@petshop.com'],
            [
                'name' => 'Kasir 1',
                'password' => Hash::make('kasir123'),
                'role' => 'kasir',
            ]
        );

        User::updateOrCreate(
            ['email' => 'kasir2@petshop.com'],
            [
                'name' => 'Kasir 2',
                'password' => Hash::make('kasir123'),
                'role' => 'kasir',
            ]
        );
    }
}