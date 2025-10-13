<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Products;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Vitamin D3 Supplement - 5000 IU',
                'image' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=300',
                'current_price' => 480.00,
                'old_price' => 600.00,
                'discount_percentage' => 20,
                'description' => 'Vitamin D3 Supplement - 5000 IU for bone health and immune system support',
                'category' => 'Vitamin & Supplements',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Omega-3 Fish Oil - 1000mg',
                'image' => 'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=300',
                'current_price' => 850.00,
                'old_price' => 1000.00,
                'discount_percentage' => 15,
                'description' => 'Omega-3 Fish Oil - 1000mg for heart and brain health',
                'category' => 'Vitamin & Supplements',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Multivitamin Complex - 60 Tablets',
                'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=300',
                'current_price' => 675.00,
                'old_price' => 900.00,
                'discount_percentage' => 25,
                'description' => 'Multivitamin Complex - 60 Tablets for overall health and wellness',
                'category' => 'Vitamin & Supplements',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Calcium + Magnesium - 120 Capsules',
                'image' => 'https://images.unsplash.com/photo-1578496479914-7ef3b0193be3?w=300',
                'current_price' => 720.00,
                'old_price' => 800.00,
                'discount_percentage' => 10,
                'description' => 'Calcium + Magnesium - 120 Capsules for strong bones and teeth',
                'category' => 'Vitamin & Supplements',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Probiotic Supplement - 30 Billion CFU',
                'image' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=300',
                'current_price' => 1050.00,
                'old_price' => 1500.00,
                'discount_percentage' => 30,
                'description' => 'Probiotic Supplement - 30 Billion CFU for digestive health',
                'category' => 'Vitamin & Supplements',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Zinc Supplement - 50mg',
                'image' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=300',
                'current_price' => 410.00,
                'old_price' => 500.00,
                'discount_percentage' => 18,
                'description' => 'Zinc Supplement - 50mg for immune system support',
                'category' => 'Vitamin & Supplements',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Iron Supplement - 65mg',
                'image' => 'https://images.unsplash.com/photo-1585435557343-3b092031a831?w=300',
                'current_price' => 390.00,
                'old_price' => 500.00,
                'discount_percentage' => 22,
                'description' => 'Iron Supplement - 65mg for energy and blood health',
                'category' => 'Vitamin & Supplements',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'B-Complex Vitamin - 100 Tablets',
                'image' => 'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=300',
                'current_price' => 528.00,
                'old_price' => 600.00,
                'discount_percentage' => 12,
                'description' => 'B-Complex Vitamin - 100 Tablets for energy metabolism and nervous system',
                'category' => 'Vitamin & Supplements',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}
