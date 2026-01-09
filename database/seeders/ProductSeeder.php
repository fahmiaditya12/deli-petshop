<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Makanan Hewan
            ['category_id' => 1, 'name' => 'Royal Canin Dog Food 2kg', 'description' => 'Makanan anjing premium kualitas terbaik', 'price' => 250000, 'stock' => 50],
            ['category_id' => 1, 'name' => 'Whiskas Cat Food 1.2kg', 'description' => 'Makanan kucing dengan nutrisi lengkap', 'price' => 85000, 'stock' => 75],
            ['category_id' => 1, 'name' => 'Me-O Kitten 1.1kg', 'description' => 'Makanan anak kucing kaya protein', 'price' => 65000, 'stock' => 60],
            ['category_id' => 1, 'name' => 'Pedigree Adult Dog 1.5kg', 'description' => 'Makanan anjing dewasa', 'price' => 120000, 'stock' => 45],
            
            // Aksesoris
            ['category_id' => 2, 'name' => 'Kalung Anjing Premium', 'description' => 'Kalung anjing bahan kulit premium', 'price' => 75000, 'stock' => 30],
            ['category_id' => 2, 'name' => 'Tempat Makan Stainless', 'description' => 'Tempat makan & minum stainless steel', 'price' => 45000, 'stock' => 40],
            ['category_id' => 2, 'name' => 'Pet Carrier Medium', 'description' => 'Tas carrier untuk bepergian', 'price' => 185000, 'stock' => 20],
            ['category_id' => 2, 'name' => 'Litter Box Kucing', 'description' => 'Kotak pasir kucing anti bau', 'price' => 95000, 'stock' => 25],
            
            // Obat-obatan
            ['category_id' => 3, 'name' => 'Vitamin Kucing Bio Katzim', 'description' => 'Vitamin untuk kesehatan kucing', 'price' => 35000, 'stock' => 50],
            ['category_id' => 3, 'name' => 'Obat Kutu Hewan', 'description' => 'Anti kutu dan tungau', 'price' => 55000, 'stock' => 40],
            ['category_id' => 3, 'name' => 'Shampo Anti Jamur', 'description' => 'Shampo khusus anti jamur', 'price' => 42000, 'stock' => 35],
            
            // Mainan
            ['category_id' => 4, 'name' => 'Bola Karet Anjing', 'description' => 'Mainan bola gigit untuk anjing', 'price' => 25000, 'stock' => 60],
            ['category_id' => 4, 'name' => 'Cat Teaser Wand', 'description' => 'Mainan tongkat untuk kucing', 'price' => 18000, 'stock' => 50],
            ['category_id' => 4, 'name' => 'Boneka Interaktif', 'description' => 'Mainan boneka dengan suara', 'price' => 65000, 'stock' => 30],
            
            // Kandang & Sangkar
            ['category_id' => 5, 'name' => 'Kandang Kucing 2 Tingkat', 'description' => 'Kandang kucing besi 2 tingkat', 'price' => 650000, 'stock' => 8],
            ['category_id' => 5, 'name' => 'Rumah Anjing Outdoor', 'description' => 'Rumah anjing kayu untuk outdoor', 'price' => 850000, 'stock' => 5],
            ['category_id' => 5, 'name' => 'Sangkar Hamster', 'description' => 'Sangkar hamster lengkap dengan mainan', 'price' => 175000, 'stock' => 15],
            
            // Grooming
            ['category_id' => 6, 'name' => 'Sisir Kucing Premium', 'description' => 'Sisir bulu kucing anti rontok', 'price' => 38000, 'stock' => 45],
            ['category_id' => 6, 'name' => 'Gunting Kuku Hewan', 'description' => 'Gunting kuku profesional', 'price' => 52000, 'stock' => 35],
            ['category_id' => 6, 'name' => 'Hair Dryer Hewan', 'description' => 'Pengering bulu hewan khusus', 'price' => 285000, 'stock' => 12],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}