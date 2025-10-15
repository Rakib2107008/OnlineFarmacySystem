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
                'image' => 'Images/1760392245_68ed743553128.jpg',
                'current_price' => 480.00,
                'old_price' => 600.00,
                'discount_percentage' => 20,
                'description' => 'Vitamin D3 Supplement - 5000 IU for bone health and immune system support',
                'category' => 'Vitamin & Supplements',
                'created_at' => now(),
                'updated_at' => now(),
                'quantity' => 100,
            ],
            [
                'name' => 'Omega-3 Fish Oil - 1000mg',
                'image' => 'Images/1760392211_68ed7413b7e05.jpg',
                'current_price' => 850.00,
                'old_price' => 1000.00,
                'discount_percentage' => 15,
                'description' => 'Omega-3 Fish Oil - 1000mg for heart and brain health',
                'category' => 'Vitamin & Supplements',
                'created_at' => now(),
                'updated_at' => now(),
                'quantity' => 100,
            ],
            [
                'name' => 'Multivitamin Complex - 60 Tablets',
                'image' => 'Images/1760392143_68ed73cf15f4a.jpg',
                'current_price' => 675.00,
                'old_price' => 900.00,
                'discount_percentage' => 25,
                'description' => 'Multivitamin Complex - 60 Tablets for overall health and wellness',
                'category' => 'Vitamin & Supplements',
                'created_at' => now(),
                'updated_at' => now(),
                'quantity' => 100,
            ],
            [
                'name' => 'Calcium + Magnesium - 120 Capsules',
                'image' => 'Images/1760392581_68ed75853594f.jpg',
                'current_price' => 720.00,
                'old_price' => 800.00,
                'discount_percentage' => 10,
                'description' => 'Calcium + Magnesium - 120 Capsules for strong bones and teeth',
                'category' => 'Vitamin & Supplements',
                'created_at' => now(),
                'updated_at' => now(),
                'quantity' => 100,
            ],
            [
                'name' => 'Probiotic Supplement - 30 Billion CFU',
                'image' => 'Images/1760392126_68ed73beeb8e6.jpg',
                'current_price' => 1050.00,
                'old_price' => 1500.00,
                'discount_percentage' => 30,
                'description' => 'Probiotic Supplement - 30 Billion CFU for digestive health',
                'category' => 'Vitamin & Supplements',
                'created_at' => now(),
                'updated_at' => now(),'quantity' => 100,
            ],
            [
                'name' => 'Zinc Supplement - 50mg',
                'image' => 'Images/1760392104_68ed73a8420ae.jpg',
                'current_price' => 410.00,
                'old_price' => 500.00,
                'discount_percentage' => 18,
                'description' => 'Zinc Supplement - 50mg for immune system support',
                'category' => 'Vitamin & Supplements',
                'created_at' => now(),
                'updated_at' => now(),
                'quantity' => 100,
            ],
            [
                'name' => 'Iron Supplement - 65mg',
                'image' => 'Images/1760392083_68ed7393d95e8.jpg',
                'current_price' => 390.00,
                'old_price' => 500.00,
                'discount_percentage' => 22,
                'description' => 'Iron Supplement - 65mg for energy and blood health',
                'category' => 'Vitamin & Supplements',
                'created_at' => now(),
                'updated_at' => now(),
                'quantity' => 100,
            ],
            [
                'name' => 'B-Complex Vitamin - 100 Tablets',
                'image' => 'Images/1760392009_68ed7349de285.jpg',
                'current_price' => 528.00,
                'old_price' => 600.00,
                'discount_percentage' => 12,
                'description' => 'B-Complex Vitamin - 100 Tablets for energy metabolism and nervous system',
                'category' => 'Vitamin & Supplements',
                'created_at' => now(),
                'updated_at' => now(),
                'quantity' => 100,
            ],
        ];

        DB::table('products')->insert($products);
    }
}
