<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Makanan Hewan', 'description' => 'Berbagai jenis makanan untuk hewan peliharaan'],
            ['name' => 'Aksesoris', 'description' => 'Aksesoris dan perlengkapan hewan peliharaan'],
            ['name' => 'Obat-obatan', 'description' => 'Obat dan vitamin untuk hewan'],
            ['name' => 'Mainan', 'description' => 'Mainan untuk hewan peliharaan'],
            ['name' => 'Kandang & Sangkar', 'description' => 'Kandang, sangkar, dan tempat tinggal hewan'],
            ['name' => 'Grooming', 'description' => 'Peralatan grooming dan perawatan hewan'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}