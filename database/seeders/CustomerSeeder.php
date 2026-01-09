<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            ['name' => 'Budi Santoso', 'phone' => '081234567890', 'address' => 'Jl. Merdeka No. 123, Jakarta', 'email' => 'budi@email.com'],
            ['name' => 'Siti Nurhaliza', 'phone' => '081234567891', 'address' => 'Jl. Sudirman No. 45, Bandung', 'email' => 'siti@email.com'],
            ['name' => 'Andi Wijaya', 'phone' => '081234567892', 'address' => 'Jl. Gatot Subroto No. 78, Surabaya', 'email' => 'andi@email.com'],
            ['name' => 'Dewi Lestari', 'phone' => '081234567893', 'address' => 'Jl. Ahmad Yani No. 56, Semarang', 'email' => null],
            ['name' => 'Rudi Hartono', 'phone' => '081234567894', 'address' => 'Jl. Diponegoro No. 89, Yogyakarta', 'email' => 'rudi@email.com'],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}