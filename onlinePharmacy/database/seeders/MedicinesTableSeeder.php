<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medicines;
use Illuminate\Support\Facades\DB;


class MedicinesTableSeeder extends Seeder
{
    public function run()
    {
       
          $medicines = [
            // Medicines Category (20 items)
            [
                'name' => 'Paracetamol 500mg',
                'description' => 'Pain reliever and fever reducer for headaches, muscle aches, and cold symptoms',
                'category' => 'Medicines',
                'old_price' => 50.00,
                'current_price' => 45.00,
                'discount_percentage' => 10,
                'stock' => 100,
                'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400'
            ],
            [
                'name' => 'Aspirin 100mg',
                'description' => 'Blood thinner and pain reliever for heart health and headaches',
                'category' => 'Medicines',
                'old_price' => 80.00,
                'current_price' => 72.00,
                'discount_percentage' => 10,
                'stock' => 150,
                'image' => 'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=400'
            ],
            [
                'name' => 'Amoxicillin 250mg',
                'description' => 'Antibiotic for bacterial infections including respiratory and urinary tract',
                'category' => 'Medicines',
                'old_price' => 120.00,
                'current_price' => 108.00,
                'discount_percentage' => 10,
                'stock' => 80,
                'image' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=400'
            ],
            [
                'name' => 'Omeprazole 20mg',
                'description' => 'Reduces stomach acid and treats heartburn, GERD, and ulcers',
                'category' => 'Medicines',
                'old_price' => 150.00,
                'current_price' => 135.00,
                'discount_percentage' => 10,
                'stock' => 120,
                'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
            ],
            [
                'name' => 'Ibuprofen 400mg',
                'description' => 'Anti-inflammatory pain reliever for arthritis, fever, and pain',
                'category' => 'Medicines',
                'old_price' => 90.00,
                'current_price' => 81.00,
                'discount_percentage' => 10,
                'stock' => 200,
                'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400'
            ],
            [
                'name' => 'Cetirizine 10mg',
                'description' => 'Antihistamine for allergy relief, hay fever, and skin allergies',
                'category' => 'Medicines',
                'old_price' => 60.00,
                'current_price' => 54.00,
                'discount_percentage' => 10,
                'stock' => 180,
                'image' => 'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=400'
            ],
            [
                'name' => 'Metformin 500mg',
                'description' => 'Diabetes medication to control blood sugar levels',
                'category' => 'Medicines',
                'old_price' => 100.00,
                'current_price' => 90.00,
                'discount_percentage' => 10,
                'stock' => 150,
                'image' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=400'
            ],
            [
                'name' => 'Atorvastatin 10mg',
                'description' => 'Cholesterol-lowering medication for heart disease prevention',
                'category' => 'Medicines',
                'old_price' => 180.00,
                'current_price' => 162.00,
                'discount_percentage' => 10,
                'stock' => 100,
                'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
            ],
            [
                'name' => 'Losartan 50mg',
                'description' => 'Blood pressure medication for hypertension management',
                'category' => 'Medicines',
                'old_price' => 140.00,
                'current_price' => 126.00,
                'discount_percentage' => 10,
                'stock' => 130,
                'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400'
            ],
            [
                'name' => 'Azithromycin 250mg',
                'description' => 'Antibiotic for respiratory infections, ear infections, and skin infections',
                'category' => 'Medicines',
                'old_price' => 160.00,
                'current_price' => 144.00,
                'discount_percentage' => 10,
                'stock' => 90,
                'image' => 'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=400'
            ],
            [
                'name' => 'Ciprofloxacin 500mg',
                'description' => 'Broad-spectrum antibiotic for bacterial infections',
                'category' => 'Medicines',
                'old_price' => 170.00,
                'current_price' => 153.00,
                'discount_percentage' => 10,
                'stock' => 85,
                'image' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=400'
            ],
            [
                'name' => 'Montelukast 10mg',
                'description' => 'Asthma and allergy medication for respiratory relief',
                'category' => 'Medicines',
                'old_price' => 190.00,
                'current_price' => 171.00,
                'discount_percentage' => 10,
                'stock' => 110,
                'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
            ],
            [
                'name' => 'Ranitidine 150mg',
                'description' => 'Reduces stomach acid for heartburn and ulcer treatment',
                'category' => 'Medicines',
                'old_price' => 75.00,
                'current_price' => 67.50,
                'discount_percentage' => 10,
                'stock' => 140,
                'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400'
            ],
            [
                'name' => 'Diclofenac 50mg',
                'description' => 'Non-steroidal anti-inflammatory for pain and inflammation',
                'category' => 'Medicines',
                'old_price' => 85.00,
                'current_price' => 76.50,
                'discount_percentage' => 10,
                'stock' => 160,
                'image' => 'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=400'
            ],
            [
                'name' => 'Levofloxacin 500mg',
                'description' => 'Antibiotic for bacterial infections including pneumonia',
                'category' => 'Medicines',
                'old_price' => 200.00,
                'current_price' => 180.00,
                'discount_percentage' => 10,
                'stock' => 75,
                'image' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=400'
            ],
            [
                'name' => 'Clopidogrel 75mg',
                'description' => 'Blood thinner to prevent heart attack and stroke',
                'category' => 'Medicines',
                'old_price' => 220.00,
                'current_price' => 198.00,
                'discount_percentage' => 10,
                'stock' => 95,
                'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
            ],
            [
                'name' => 'Gabapentin 300mg',
                'description' => 'Nerve pain medication for neuropathic pain and seizures',
                'category' => 'Medicines',
                'old_price' => 210.00,
                'current_price' => 189.00,
                'discount_percentage' => 10,
                'stock' => 80,
                'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400'
            ],
            [
                'name' => 'Prednisolone 5mg',
                'description' => 'Corticosteroid for inflammation, allergies, and immune conditions',
                'category' => 'Medicines',
                'old_price' => 95.00,
                'current_price' => 85.50,
                'discount_percentage' => 10,
                'stock' => 125,
                'image' => 'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=400'
            ],
            [
                'name' => 'Pantoprazole 40mg',
                'description' => 'Proton pump inhibitor for acid reflux and stomach ulcers',
                'category' => 'Medicines',
                'old_price' => 130.00,
                'current_price' => 117.00,
                'discount_percentage' => 10,
                'stock' => 135,
                'image' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=400'
            ],
            [
                'name' => 'Tramadol 50mg',
                'description' => 'Pain reliever for moderate to severe pain management',
                'category' => 'Medicines',
                'old_price' => 110.00,
                'current_price' => 99.00,
                'discount_percentage' => 10,
                'stock' => 70,
                'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
            ],

            // Diabetics Category (20 items)
            [
                'name' => 'Glucometer Digital',
                'description' => 'Blood glucose monitoring system with LCD display and memory',
                'category' => 'Diabetics',
                'old_price' => 1500.00,
                'current_price' => 1350.00,
                'discount_percentage' => 10,
                'stock' => 50,
                'image' => 'https://images.unsplash.com/photo-1615461066159-fea0960485d5?w=400'
            ],
            [
                'name' => 'Test Strips (50 pcs)',
                'description' => 'Blood glucose test strips for accurate sugar level monitoring',
                'category' => 'Diabetics',
                'old_price' => 800.00,
                'current_price' => 720.00,
                'discount_percentage' => 10,
                'stock' => 100,
                'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400'
            ],
            [
                'name' => 'Lancets (100 pcs)',
                'description' => 'Sterile lancets for blood sampling with minimal pain',
                'category' => 'Diabetics',
                'old_price' => 300.00,
                'current_price' => 270.00,
                'discount_percentage' => 10,
                'stock' => 150,
                'image' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=400'
            ],
            [
                'name' => 'Insulin Pen',
                'description' => 'Reusable insulin pen for easy and accurate insulin delivery',
                'category' => 'Diabetics',
                'old_price' => 2500.00,
                'current_price' => 2250.00,
                'discount_percentage' => 10,
                'stock' => 40,
                'image' => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=400'
            ],
            [
                'name' => 'Insulin Needles (100 pcs)',
                'description' => 'Ultra-fine insulin needles for comfortable injections',
                'category' => 'Diabetics',
                'old_price' => 500.00,
                'current_price' => 450.00,
                'discount_percentage' => 10,
                'stock' => 120,
                'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400'
            ],
            [
                'name' => 'Diabetic Socks',
                'description' => 'Non-binding socks for diabetic foot care and circulation',
                'category' => 'Diabetics',
                'old_price' => 400.00,
                'current_price' => 360.00,
                'discount_percentage' => 10,
                'stock' => 80,
                'image' => 'https://images.unsplash.com/photo-1586350977771-b3b0abd50c82?w=400'
            ],
            [
                'name' => 'Sugar-Free Supplements',
                'description' => 'Multivitamin supplements specially formulated for diabetics',
                'category' => 'Diabetics',
                'old_price' => 600.00,
                'current_price' => 540.00,
                'discount_percentage' => 10,
                'stock' => 90,
                'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
            ],
            [
                'name' => 'Glucose Tablets',
                'description' => 'Fast-acting glucose tablets for low blood sugar emergency',
                'category' => 'Diabetics',
                'old_price' => 250.00,
                'current_price' => 225.00,
                'discount_percentage' => 10,
                'stock' => 110,
                'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400'
            ],
            [
                'name' => 'Insulin Cooler Bag',
                'description' => 'Portable insulated bag for insulin storage and travel',
                'category' => 'Diabetics',
                'old_price' => 1200.00,
                'current_price' => 1080.00,
                'discount_percentage' => 10,
                'stock' => 60,
                'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400'
            ],
            [
                'name' => 'Diabetic Food Scale',
                'description' => 'Digital kitchen scale for accurate portion control and meal planning',
                'category' => 'Diabetics',
                'old_price' => 800.00,
                'current_price' => 720.00,
                'discount_percentage' => 10,
                'stock' => 70,
                'image' => 'https://images.unsplash.com/photo-1615461066159-fea0960485d5?w=400'
            ],
            [
                'name' => 'HbA1c Test Kit',
                'description' => 'Home testing kit for glycated hemoglobin monitoring',
                'category' => 'Diabetics',
                'old_price' => 1800.00,
                'current_price' => 1620.00,
                'discount_percentage' => 10,
                'stock' => 45,
                'image' => 'https://images.unsplash.com/photo-1615461066159-fea0960485d5?w=400'
            ],
            [
                'name' => 'Diabetic Foot Cream',
                'description' => 'Moisturizing cream specially formulated for diabetic foot care',
                'category' => 'Diabetics',
                'old_price' => 350.00,
                'current_price' => 315.00,
                'discount_percentage' => 10,
                'stock' => 100,
                'image' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=400'
            ],
            [
                'name' => 'Continuous Glucose Monitor',
                'description' => 'Advanced CGM system for real-time glucose monitoring',
                'category' => 'Diabetics',
                'old_price' => 5000.00,
                'current_price' => 4500.00,
                'discount_percentage' => 10,
                'stock' => 25,
                'image' => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=400'
            ],
            [
                'name' => 'Sugar-Free Energy Drink',
                'description' => 'Diabetic-friendly energy drink with zero sugar',
                'category' => 'Diabetics',
                'old_price' => 150.00,
                'current_price' => 135.00,
                'discount_percentage' => 10,
                'stock' => 200,
                'image' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=400'
            ],
            [
                'name' => 'Ketone Test Strips',
                'description' => 'Urine test strips for ketone level monitoring',
                'category' => 'Diabetics',
                'old_price' => 400.00,
                'current_price' => 360.00,
                'discount_percentage' => 10,
                'stock' => 85,
                'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400'
            ],
            [
                'name' => 'Diabetic Meal Replacement Shake',
                'description' => 'Nutritionally balanced shake for diabetic diet management',
                'category' => 'Diabetics',
                'old_price' => 650.00,
                'current_price' => 585.00,
                'discount_percentage' => 10,
                'stock' => 75,
                'image' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=400'
            ],
            [
                'name' => 'Blood Glucose Logbook',
                'description' => 'Tracker journal for recording blood sugar readings and medications',
                'category' => 'Diabetics',
                'old_price' => 200.00,
                'current_price' => 180.00,
                'discount_percentage' => 10,
                'stock' => 120,
                'image' => 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=400'
            ],
            [
                'name' => 'Insulin Syringe (100 pcs)',
                'description' => 'Disposable insulin syringes with ultra-fine needles',
                'category' => 'Diabetics',
                'old_price' => 700.00,
                'current_price' => 630.00,
                'discount_percentage' => 10,
                'stock' => 95,
                'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400'
            ],
            [
                'name' => 'Diabetic Alert Bracelet',
                'description' => 'Medical ID bracelet for emergency diabetic identification',
                'category' => 'Diabetics',
                'old_price' => 500.00,
                'current_price' => 450.00,
                'discount_percentage' => 10,
                'stock' => 65,
                'image' => 'https://images.unsplash.com/photo-1586350977771-b3b0abd50c82?w=400'
            ],
            [
                'name' => 'Sugar-Free Protein Bar (12 pack)',
                'description' => 'High-protein, low-carb bars suitable for diabetic diet',
                'category' => 'Diabetics',
                'old_price' => 450.00,
                'current_price' => 405.00,
                'discount_percentage' => 10,
                'stock' => 110,
                'image' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=400'
            ],


            // Personal Care Category (20 items)
            [
                'name' => 'Hand Sanitizer 500ml',
                'description' => 'Antibacterial hand sanitizer with 70% alcohol for effective germ protection',
                'category' => 'Personal Care',
                'old_price' => 250.00,
                'current_price' => 225.00,
                'discount_percentage' => 10,
                'stock' => 200,
                'image' => 'https://images.unsplash.com/photo-1584516150432-c78178dc25e6?w=400'
            ],
            [
                'name' => 'Face Mask (50 pcs)',
                'description' => 'Disposable 3-ply surgical face masks for daily protection',
                'category' => 'Personal Care',
                'old_price' => 400.00,
                'current_price' => 360.00,
                'discount_percentage' => 10,
                'stock' => 150,
                'image' => 'https://images.unsplash.com/photo-1585559604959-6388fe69c92a?w=400'
            ],
            [
                'name' => 'Antibacterial Soap',
                'description' => 'Gentle antibacterial soap for hand and body cleansing',
                'category' => 'Personal Care',
                'old_price' => 180.00,
                'current_price' => 162.00,
                'discount_percentage' => 10,
                'stock' => 180,
                'image' => 'https://images.unsplash.com/photo-1585421514738-01798e348b17?w=400'
            ],
            [
                'name' => 'Cotton Balls (200 pcs)',
                'description' => 'Pure cotton balls for makeup removal and wound care',
                'category' => 'Personal Care',
                'old_price' => 120.00,
                'current_price' => 108.00,
                'discount_percentage' => 10,
                'stock' => 160,
                'image' => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=400'
            ],
            [
                'name' => 'Cotton Swabs (100 pcs)',
                'description' => 'Sterile cotton swabs for ear cleaning and cosmetic application',
                'category' => 'Personal Care',
                'old_price' => 100.00,
                'current_price' => 90.00,
                'discount_percentage' => 10,
                'stock' => 190,
                'image' => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=400'
            ],
            [
                'name' => 'Baby Wipes (80 sheets)',
                'description' => 'Soft and gentle baby wipes for sensitive skin',
                'category' => 'Personal Care',
                'old_price' => 220.00,
                'current_price' => 198.00,
                'discount_percentage' => 10,
                'stock' => 140,
                'image' => 'https://images.unsplash.com/photo-1584516150432-c78178dc25e6?w=400'
            ],
            [
                'name' => 'Antiseptic Cream 50g',
                'description' => 'Antibacterial cream for minor cuts, burns, and skin infections',
                'category' => 'Personal Care',
                'old_price' => 150.00,
                'current_price' => 135.00,
                'discount_percentage' => 10,
                'stock' => 120,
                'image' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=400'
            ],
            [
                'name' => 'Toothbrush Pack (4 pcs)',
                'description' => 'Soft-bristle toothbrushes for gentle dental care',
                'category' => 'Personal Care',
                'old_price' => 200.00,
                'current_price' => 180.00,
                'discount_percentage' => 10,
                'stock' => 110,
                'image' => 'https://images.unsplash.com/photo-1607613009820-a29f7bb81c04?w=400'
            ],
            [
                'name' => 'Toothpaste Medicated',
                'description' => 'Fluoride toothpaste for cavity protection and fresh breath',
                'category' => 'Personal Care',
                'old_price' => 180.00,
                'current_price' => 162.00,
                'discount_percentage' => 10,
                'stock' => 170,
                'image' => 'https://images.unsplash.com/photo-1585421514738-01798e348b17?w=400'
            ],
            [
                'name' => 'Mouthwash Antiseptic 500ml',
                'description' => 'Antibacterial mouthwash for oral hygiene and fresh breath',
                'category' => 'Personal Care',
                'old_price' => 280.00,
                'current_price' => 252.00,
                'discount_percentage' => 10,
                'stock' => 95,
                'image' => 'https://images.unsplash.com/photo-1585421514738-01798e348b17?w=400'
            ],
            [
                'name' => 'Tissues Box (200 sheets)',
                'description' => 'Soft facial tissues for everyday use',
                'category' => 'Personal Care',
                'old_price' => 150.00,
                'current_price' => 135.00,
                'discount_percentage' => 10,
                'stock' => 180,
                'image' => 'https://images.unsplash.com/photo-1631549916768-4119b2e5f926?w=400'
            ],
            [
                'name' => 'Petroleum Jelly 100g',
                'description' => 'Multi-purpose petroleum jelly for skin moisturizing and protection',
                'category' => 'Personal Care',
                'old_price' => 120.00,
                'current_price' => 108.00,
                'discount_percentage' => 10,
                'stock' => 150,
                'image' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=400'
            ],
            [
                'name' => 'Nail Clipper Set',
                'description' => 'Stainless steel nail clipper set with file for precise grooming',
                'category' => 'Personal Care',
                'old_price' => 300.00,
                'current_price' => 270.00,
                'discount_percentage' => 10,
                'stock' => 85,
                'image' => 'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400'
            ],
            [
                'name' => 'Deodorant Spray 150ml',
                'description' => 'Long-lasting antiperspirant deodorant for all-day freshness',
                'category' => 'Personal Care',
                'old_price' => 350.00,
                'current_price' => 315.00,
                'discount_percentage' => 10,
                'stock' => 130,
                'image' => 'https://images.unsplash.com/photo-1598440947619-2c35fc9aa908?w=400'
            ],
            [
                'name' => 'Body Lotion 200ml',
                'description' => 'Moisturizing body lotion for soft and hydrated skin',
                'category' => 'Personal Care',
                'old_price' => 400.00,
                'current_price' => 360.00,
                'discount_percentage' => 10,
                'stock' => 100,
                'image' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=400'
            ],
            [
                'name' => 'Sunscreen SPF 50+ 100ml',
                'description' => 'Broad-spectrum sunscreen for UVA and UVB protection',
                'category' => 'Personal Care',
                'old_price' => 500.00,
                'current_price' => 450.00,
                'discount_percentage' => 10,
                'stock' => 90,
                'image' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=400'
            ],
            [
                'name' => 'Shampoo Anti-Dandruff 400ml',
                'description' => 'Medicated shampoo for dandruff control and scalp health',
                'category' => 'Personal Care',
                'old_price' => 450.00,
                'current_price' => 405.00,
                'discount_percentage' => 10,
                'stock' => 110,
                'image' => 'https://images.unsplash.com/photo-1585421514738-01798e348b17?w=400'
            ],
            [
                'name' => 'Hair Conditioner 400ml',
                'description' => 'Nourishing hair conditioner for smooth and shiny hair',
                'category' => 'Personal Care',
                'old_price' => 420.00,
                'current_price' => 378.00,
                'discount_percentage' => 10,
                'stock' => 105,
                'image' => 'https://images.unsplash.com/photo-1585421514738-01798e348b17?w=400'
            ],
            [
                'name' => 'Wet Wipes Antibacterial (50 pcs)',
                'description' => 'Disposable antibacterial wet wipes for on-the-go cleaning',
                'category' => 'Personal Care',
                'old_price' => 180.00,
                'current_price' => 162.00,
                'discount_percentage' => 10,
                'stock' => 160,
                'image' => 'https://images.unsplash.com/photo-1584516150432-c78178dc25e6?w=400'
            ],
            [
                'name' => 'Face Wash Gentle Cleanser 150ml',
                'description' => 'pH-balanced face wash for daily cleansing and acne control',
                'category' => 'Personal Care',
                'old_price' => 320.00,
                'current_price' => 288.00,
                'discount_percentage' => 10,
                'stock' => 125,
                'image' => 'https://images.unsplash.com/photo-1556228578-8c89e6adf883?w=400'
            ],


            [
    'name' => 'Vitamin C 1000mg',
    'description' => 'Immune booster with antioxidant properties for daily wellness',
    'category' => 'Vitamin Supplements',
    'old_price' => 250.00,
    'current_price' => 225.00,
    'discount_percentage' => 10,
    'stock' => 200,
    'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
],
[
    'name' => 'Vitamin D3 2000 IU',
    'description' => 'Bone health support and calcium absorption enhancement',
    'category' => 'Vitamin Supplements',
    'old_price' => 300.00,
    'current_price' => 270.00,
    'discount_percentage' => 10,
    'stock' => 180,
    'image' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=400'
],
[
    'name' => 'Multivitamin Complex',
    'description' => 'Complete daily multivitamin with essential minerals and vitamins',
    'category' => 'Vitamin Supplements',
    'old_price' => 450.00,
    'current_price' => 405.00,
    'discount_percentage' => 10,
    'stock' => 150,
    'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400'
],
[
    'name' => 'Omega-3 Fish Oil',
    'description' => 'Heart health support with EPA and DHA fatty acids',
    'category' => 'Vitamin Supplements',
    'old_price' => 550.00,
    'current_price' => 495.00,
    'discount_percentage' => 10,
    'stock' => 130,
    'image' => 'https://images.unsplash.com/photo-1579722820308-d74e571900a9?w=400'
],
[
    'name' => 'Vitamin B Complex',
    'description' => 'Energy metabolism support with all B vitamins',
    'category' => 'Vitamin Supplements',
    'old_price' => 320.00,
    'current_price' => 288.00,
    'discount_percentage' => 10,
    'stock' => 170,
    'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
],
[
    'name' => 'Calcium + Magnesium',
    'description' => 'Bone strength formula with vitamin D for better absorption',
    'category' => 'Vitamin Supplements',
    'old_price' => 380.00,
    'current_price' => 342.00,
    'discount_percentage' => 10,
    'stock' => 140,
    'image' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=400'
],
[
    'name' => 'Zinc 50mg',
    'description' => 'Immune system support and wound healing mineral',
    'category' => 'Vitamin Supplements',
    'old_price' => 220.00,
    'current_price' => 198.00,
    'discount_percentage' => 10,
    'stock' => 190,
    'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400'
],
[
    'name' => 'Iron + Folic Acid',
    'description' => 'Blood health supplement for anemia prevention',
    'category' => 'Vitamin Supplements',
    'old_price' => 280.00,
    'current_price' => 252.00,
    'discount_percentage' => 10,
    'stock' => 160,
    'image' => 'https://images.unsplash.com/photo-1579722820308-d74e571900a9?w=400'
],
[
    'name' => 'Vitamin E 400 IU',
    'description' => 'Antioxidant for skin health and cellular protection',
    'category' => 'Vitamin Supplements',
    'old_price' => 350.00,
    'current_price' => 315.00,
    'discount_percentage' => 10,
    'stock' => 145,
    'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
],
[
    'name' => 'Biotin 10000mcg',
    'description' => 'Hair, skin, and nail health supplement',
    'category' => 'Vitamin Supplements',
    'old_price' => 400.00,
    'current_price' => 360.00,
    'discount_percentage' => 10,
    'stock' => 155,
    'image' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=400'
],
[
    'name' => 'Collagen Peptides',
    'description' => 'Skin elasticity and joint health support powder',
    'category' => 'Vitamin Supplements',
    'old_price' => 800.00,
    'current_price' => 720.00,
    'discount_percentage' => 10,
    'stock' => 90,
    'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400'
],
[
    'name' => 'Probiotics 10 Billion CFU',
    'description' => 'Digestive health and gut flora balance supplement',
    'category' => 'Vitamin Supplements',
    'old_price' => 650.00,
    'current_price' => 585.00,
    'discount_percentage' => 10,
    'stock' => 110,
    'image' => 'https://images.unsplash.com/photo-1579722820308-d74e571900a9?w=400'
],
[
    'name' => 'Coenzyme Q10 100mg',
    'description' => 'Heart health and energy production support',
    'category' => 'Vitamin Supplements',
    'old_price' => 750.00,
    'current_price' => 675.00,
    'discount_percentage' => 10,
    'stock' => 85,
    'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
],
[
    'name' => 'Glucosamine Chondroitin',
    'description' => 'Joint health and cartilage support formula',
    'category' => 'Vitamin Supplements',
    'old_price' => 700.00,
    'current_price' => 630.00,
    'discount_percentage' => 10,
    'stock' => 100,
    'image' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=400'
],
[
    'name' => 'Vitamin K2 + D3',
    'description' => 'Bone and cardiovascular health combination',
    'category' => 'Vitamin Supplements',
    'old_price' => 420.00,
    'current_price' => 378.00,
    'discount_percentage' => 10,
    'stock' => 125,
    'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400'
],
[
    'name' => 'Turmeric Curcumin',
    'description' => 'Anti-inflammatory supplement with BioPerine for absorption',
    'category' => 'Vitamin Supplements',
    'old_price' => 480.00,
    'current_price' => 432.00,
    'discount_percentage' => 10,
    'stock' => 135,
    'image' => 'https://images.unsplash.com/photo-1579722820308-d74e571900a9?w=400'
],
[
    'name' => 'Ashwagandha 600mg',
    'description' => 'Stress relief and energy boost adaptogen supplement',
    'category' => 'Vitamin Supplements',
    'old_price' => 520.00,
    'current_price' => 468.00,
    'discount_percentage' => 10,
    'stock' => 120,
    'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
],
[
    'name' => 'Magnesium Glycinate 400mg',
    'description' => 'Sleep support and muscle relaxation mineral',
    'category' => 'Vitamin Supplements',
    'old_price' => 360.00,
    'current_price' => 324.00,
    'discount_percentage' => 10,
    'stock' => 165,
    'image' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=400'
],
[
    'name' => 'Apple Cider Vinegar Gummies',
    'description' => 'Weight management and digestive health support',
    'category' => 'Vitamin Supplements',
    'old_price' => 340.00,
    'current_price' => 306.00,
    'discount_percentage' => 10,
    'stock' => 175,
    'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400'
],
[
    'name' => 'L-Carnitine 1000mg',
    'description' => 'Fat metabolism and energy production supplement',
    'category' => 'Vitamin Supplements',
    'old_price' => 580.00,
    'current_price' => 522.00,
    'discount_percentage' => 10,
    'stock' => 95,
    'image' => 'https://images.unsplash.com/photo-1579722820308-d74e571900a9?w=400'
],

// Women Care Category (20 items)
[
    'name' => 'Prenatal Vitamins',
    'description' => 'Complete nutrition support for pregnancy with folic acid and iron',
    'category' => 'Women Care',
    'old_price' => 600.00,
    'current_price' => 540.00,
    'discount_percentage' => 10,
    'stock' => 120,
    'image' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=400'
],
[
    'name' => 'Sanitary Pads Regular',
    'description' => 'Ultra-soft cotton sanitary pads with wings (Pack of 10)',
    'category' => 'Women Care',
    'old_price' => 180.00,
    'current_price' => 162.00,
    'discount_percentage' => 10,
    'stock' => 250,
    'image' => 'https://images.unsplash.com/photo-1586041828039-d753b1962343?w=400'
],
[
    'name' => 'Menstrual Cup',
    'description' => 'Reusable medical-grade silicone menstrual cup',
    'category' => 'Women Care',
    'old_price' => 450.00,
    'current_price' => 405.00,
    'discount_percentage' => 10,
    'stock' => 80,
    'image' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400'
],
[
    'name' => 'Intimate Wash pH Balanced',
    'description' => 'Gentle feminine hygiene wash with natural ingredients',
    'category' => 'Women Care',
    'old_price' => 320.00,
    'current_price' => 288.00,
    'discount_percentage' => 10,
    'stock' => 150,
    'image' => 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=400'
],
[
    'name' => 'Evening Primrose Oil',
    'description' => 'Hormonal balance and PMS relief supplement',
    'category' => 'Women Care',
    'old_price' => 550.00,
    'current_price' => 495.00,
    'discount_percentage' => 10,
    'stock' => 100,
    'image' => 'https://images.unsplash.com/photo-1579722820308-d74e571900a9?w=400'
],
[
    'name' => 'Folic Acid 5mg',
    'description' => 'Essential supplement for pregnancy planning and neural development',
    'category' => 'Women Care',
    'old_price' => 200.00,
    'current_price' => 180.00,
    'discount_percentage' => 10,
    'stock' => 180,
    'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400'
],
[
    'name' => 'Pregnancy Test Kit (3 pcs)',
    'description' => 'Early detection home pregnancy test with 99% accuracy',
    'category' => 'Women Care',
    'old_price' => 280.00,
    'current_price' => 252.00,
    'discount_percentage' => 10,
    'stock' => 200,
    'image' => 'https://images.unsplash.com/photo-1615461066841-6116e61058f4?w=400'
],
[
    'name' => 'Ovulation Test Strips',
    'description' => 'Fertility tracking strips for ovulation prediction (Pack of 10)',
    'category' => 'Women Care',
    'old_price' => 350.00,
    'current_price' => 315.00,
    'discount_percentage' => 10,
    'stock' => 130,
    'image' => 'https://images.unsplash.com/photo-1615461066159-fea0960485d5?w=400'
],
[
    'name' => 'Cranberry Extract Capsules',
    'description' => 'Urinary tract health support for women',
    'category' => 'Women Care',
    'old_price' => 420.00,
    'current_price' => 378.00,
    'discount_percentage' => 10,
    'stock' => 110,
    'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
],
[
    'name' => 'Iron Supplement for Women',
    'description' => 'Gentle iron formula for menstrual blood loss support',
    'category' => 'Women Care',
    'old_price' => 300.00,
    'current_price' => 270.00,
    'discount_percentage' => 10,
    'stock' => 160,
    'image' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=400'
],
[
    'name' => 'Breast Pads Disposable',
    'description' => 'Ultra-absorbent nursing pads for breastfeeding (Pack of 30)',
    'category' => 'Women Care',
    'old_price' => 250.00,
    'current_price' => 225.00,
    'discount_percentage' => 10,
    'stock' => 140,
    'image' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400'
],
[
    'name' => 'Vaginal Moisturizer',
    'description' => 'Long-lasting intimate moisture relief gel',
    'category' => 'Women Care',
    'old_price' => 480.00,
    'current_price' => 432.00,
    'discount_percentage' => 10,
    'stock' => 90,
    'image' => 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=400'
],
[
    'name' => 'Calcium + Vitamin D for Women',
    'description' => 'Bone health formula designed for women\'s needs',
    'category' => 'Women Care',
    'old_price' => 380.00,
    'current_price' => 342.00,
    'discount_percentage' => 10,
    'stock' => 155,
    'image' => 'https://images.unsplash.com/photo-1579722820308-d74e571900a9?w=400'
],
[
    'name' => 'Panty Liners Unscented',
    'description' => 'Daily freshness ultra-thin panty liners (Pack of 20)',
    'category' => 'Women Care',
    'old_price' => 150.00,
    'current_price' => 135.00,
    'discount_percentage' => 10,
    'stock' => 220,
    'image' => 'https://images.unsplash.com/photo-1586041828039-d753b1962343?w=400'
],
[
    'name' => 'Hair Skin Nails Formula',
    'description' => 'Beauty supplement with biotin and collagen for women',
    'category' => 'Women Care',
    'old_price' => 520.00,
    'current_price' => 468.00,
    'discount_percentage' => 10,
    'stock' => 125,
    'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
],
[
    'name' => 'Menopause Support Formula',
    'description' => 'Natural relief for hot flashes and hormonal changes',
    'category' => 'Women Care',
    'old_price' => 650.00,
    'current_price' => 585.00,
    'discount_percentage' => 10,
    'stock' => 85,
    'image' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=400'
],
[
    'name' => 'Kegel Exercise Balls',
    'description' => 'Pelvic floor strengthening device for women',
    'category' => 'Women Care',
    'old_price' => 800.00,
    'current_price' => 720.00,
    'discount_percentage' => 10,
    'stock' => 60,
    'image' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400'
],
[
    'name' => 'Feminine Wipes',
    'description' => 'Gentle cleansing wipes for intimate care (Pack of 20)',
    'category' => 'Women Care',
    'old_price' => 220.00,
    'current_price' => 198.00,
    'discount_percentage' => 10,
    'stock' => 190,
    'image' => 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=400'
],
[
    'name' => 'Period Pain Relief Patch',
    'description' => 'Heat therapy patches for menstrual cramp relief (Pack of 5)',
    'category' => 'Women Care',
    'old_price' => 280.00,
    'current_price' => 252.00,
    'discount_percentage' => 10,
    'stock' => 175,
    'image' => 'https://images.unsplash.com/photo-1586041828039-d753b1962343?w=400'
],
[
    'name' => 'Collagen Drink for Women',
    'description' => 'Anti-aging beauty drink with marine collagen',
    'category' => 'Women Care',
    'old_price' => 900.00,
    'current_price' => 810.00,
    'discount_percentage' => 10,
    'stock' => 70,
    'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
],

// Baby & Mom Category (20 items)
[
    'name' => 'Baby Diapers Size M',
    'description' => 'Ultra-absorbent disposable diapers with wetness indicator (Pack of 44)',
    'category' => 'Baby & Mom',
    'old_price' => 850.00,
    'current_price' => 765.00,
    'discount_percentage' => 10,
    'stock' => 200,
    'image' => 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=400'
],
[
    'name' => 'Baby Wipes Sensitive',
    'description' => 'Alcohol-free gentle wipes for newborn sensitive skin (Pack of 80)',
    'category' => 'Baby & Mom',
    'old_price' => 280.00,
    'current_price' => 252.00,
    'discount_percentage' => 10,
    'stock' => 300,
    'image' => 'https://images.unsplash.com/photo-1584931423298-c576fda54bd2?w=400'
],
[
    'name' => 'Baby Formula Milk 0-6M',
    'description' => 'Stage 1 infant formula with DHA and probiotics (400g)',
    'category' => 'Baby & Mom',
    'old_price' => 1200.00,
    'current_price' => 1080.00,
    'discount_percentage' => 10,
    'stock' => 150,
    'image' => 'https://images.unsplash.com/photo-1586041828039-d753b1962343?w=400'
],
[
    'name' => 'Baby Bottle BPA Free',
    'description' => 'Anti-colic feeding bottle with slow flow nipple (250ml)',
    'category' => 'Baby & Mom',
    'old_price' => 450.00,
    'current_price' => 405.00,
    'discount_percentage' => 10,
    'stock' => 180,
    'image' => 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=400'
],
[
    'name' => 'Breast Pump Electric',
    'description' => 'Double electric breast pump with massage mode',
    'category' => 'Baby & Mom',
    'old_price' => 3500.00,
    'current_price' => 3150.00,
    'discount_percentage' => 10,
    'stock' => 45,
    'image' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400'
],
[
    'name' => 'Baby Shampoo Tear-Free',
    'description' => 'Gentle hypoallergenic baby shampoo with natural ingredients',
    'category' => 'Baby & Mom',
    'old_price' => 320.00,
    'current_price' => 288.00,
    'discount_percentage' => 10,
    'stock' => 220,
    'image' => 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=400'
],
[
    'name' => 'Baby Lotion Moisturizing',
    'description' => 'Non-greasy baby lotion for soft and smooth skin',
    'category' => 'Baby & Mom',
    'old_price' => 350.00,
    'current_price' => 315.00,
    'discount_percentage' => 10,
    'stock' => 200,
    'image' => 'https://images.unsplash.com/photo-1584931423298-c576fda54bd2?w=400'
],
[
    'name' => 'Diaper Rash Cream',
    'description' => 'Zinc oxide barrier cream for diaper rash treatment',
    'category' => 'Baby & Mom',
    'old_price' => 280.00,
    'current_price' => 252.00,
    'discount_percentage' => 10,
    'stock' => 190,
    'image' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400'
],
[
    'name' => 'Baby Thermometer Digital',
    'description' => 'Fast and accurate forehead thermometer with fever alarm',
    'category' => 'Baby & Mom',
    'old_price' => 800.00,
    'current_price' => 720.00,
    'discount_percentage' => 10,
    'stock' => 110,
    'image' => 'https://images.unsplash.com/photo-1615461066159-fea0960485d5?w=400'
],
[
    'name' => 'Baby Nail Clipper Set',
    'description' => 'Safe nail care set with scissors and file for newborns',
    'category' => 'Baby & Mom',
    'old_price' => 250.00,
    'current_price' => 225.00,
    'discount_percentage' => 10,
    'stock' => 160,
    'image' => 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=400'
],
[
    'name' => 'Baby Vitamin D Drops',
    'description' => 'Essential vitamin D3 supplement for infants (400 IU)',
    'category' => 'Baby & Mom',
    'old_price' => 380.00,
    'current_price' => 342.00,
    'discount_percentage' => 10,
    'stock' => 140,
    'image' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=400'
],
[
    'name' => 'Pacifier Orthodontic',
    'description' => 'Silicone pacifier promoting proper oral development (0-6M)',
    'category' => 'Baby & Mom',
    'old_price' => 180.00,
    'current_price' => 162.00,
    'discount_percentage' => 10,
    'stock' => 250,
    'image' => 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=400'
],
[
    'name' => 'Baby Bath Tub',
    'description' => 'Foldable baby bathtub with temperature indicator',
    'category' => 'Baby & Mom',
    'old_price' => 1500.00,
    'current_price' => 1350.00,
    'discount_percentage' => 10,
    'stock' => 60,
    'image' => 'https://images.unsplash.com/photo-1584931423298-c576fda54bd2?w=400'
],
[
    'name' => 'Nursing Pillow',
    'description' => 'Ergonomic breastfeeding support pillow with washable cover',
    'category' => 'Baby & Mom',
    'old_price' => 1200.00,
    'current_price' => 1080.00,
    'discount_percentage' => 10,
    'stock' => 75,
    'image' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400'
],
[
    'name' => 'Baby Powder Talc-Free',
    'description' => 'Safe cornstarch-based baby powder for moisture control',
    'category' => 'Baby & Mom',
    'old_price' => 220.00,
    'current_price' => 198.00,
    'discount_percentage' => 10,
    'stock' => 210,
    'image' => 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=400'
],
[
    'name' => 'Baby Food Maker',
    'description' => 'All-in-one steamer and blender for homemade baby food',
    'category' => 'Baby & Mom',
    'old_price' => 2800.00,
    'current_price' => 2520.00,
    'discount_percentage' => 10,
    'stock' => 50,
    'image' => 'https://images.unsplash.com/photo-1515488042361-ee00e0ddd4e4?w=400'
],
[
    'name' => 'Baby Monitor Audio',
    'description' => 'Two-way audio baby monitor with night light',
    'category' => 'Baby & Mom',
    'old_price' => 2200.00,
    'current_price' => 1980.00,
    'discount_percentage' => 10,
    'stock' => 55,
    'image' => 'https://images.unsplash.com/photo-1615461066159-fea0960485d5?w=400'
],
[
    'name' => 'Baby Carrier Wrap',
    'description' => 'Adjustable baby carrier for newborn to toddler',
    'category' => 'Baby & Mom',
    'old_price' => 1800.00,
    'current_price' => 1620.00,
    'discount_percentage' => 10,
    'stock' => 90,
    'image' => 'https://images.unsplash.com/photo-1584931423298-c576fda54bd2?w=400'
],
[
    'name' => 'Teething Gel Natural',
    'description' => 'Soothing benzocaine-free gel for teething pain relief',
    'category' => 'Baby & Mom',
    'old_price' => 320.00,
    'current_price' => 288.00,
    'discount_percentage' => 10,
    'stock' => 170,
    'image' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400'
],
 [
                'name' => 'Condoms Ultra Thin',
                'description' => 'Premium latex condoms for enhanced sensitivity (Pack of 12)',
                'category' => 'Reproductive Wellness',
                'old_price' => 300.00,
                'current_price' => 270.00,
                'discount_percentage' => 10,
                'stock' => 250,
                'image' => 'https://images.unsplash.com/photo-1583947215259-38e31be8751f?w=400'
            ],
            [
                'name' => 'Personal Lubricant Water-Based',
                'description' => 'Long-lasting intimate lubricant for enhanced comfort',
                'category' => 'Reproductive Wellness',
                'old_price' => 450.00,
                'current_price' => 405.00,
                'discount_percentage' => 10,
                'stock' => 180,
                'image' => 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=400'
            ],
            [
                'name' => 'Testosterone Booster',
                'description' => 'Natural male vitality supplement with herbs and minerals',
                'category' => 'Reproductive Wellness',
                'old_price' => 850.00,
                'current_price' => 765.00,
                'discount_percentage' => 10,
                'stock' => 100,
                'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
            ],
            [
                'name' => 'Maca Root Extract',
                'description' => 'Energy and libido support supplement for men and women',
                'category' => 'Reproductive Wellness',
                'old_price' => 680.00,
                'current_price' => 612.00,
                'discount_percentage' => 10,
                'stock' => 120,
                'image' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=400'
            ],
            [
                'name' => 'Condoms Dotted & Ribbed',
                'description' => 'Textured condoms for extra pleasure (Pack of 10)',
                'category' => 'eproductive Wellness',
                'old_price' => 350.00,
                'current_price' => 315.00,
                'discount_percentage' => 10,
                'stock' => 220,
                'image' => 'https://images.unsplash.com/photo-1583947215259-38e31be8751f?w=400'
            ],
            [
                'name' => 'Delay Spray for Men',
                'description' => 'Desensitizing spray for premature ejaculation control',
                'category' => 'Reproductive Wellness',
                'old_price' => 750.00,
                'current_price' => 675.00,
                'discount_percentage' => 10,
                'stock' => 90,
                'image' => 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=400'
            ],
            [
                'name' => 'Sildenafil 50mg',
                'description' => 'Erectile dysfunction medication for improved performance',
                'category' => 'Reproductive Wellness',
                'old_price' => 400.00,
                'current_price' => 360.00,
                'discount_percentage' => 10,
                'stock' => 150,
                'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?w=400'
            ],
            [
                'name' => 'Tadalafil 20mg',
                'description' => 'Long-acting ED medication for up to 36 hours',
                'category' => 'Reproductive Wellness',
                'old_price' => 500.00,
                'current_price' => 450.00,
                'discount_percentage' => 10,
                'stock' => 130,
                'image' => 'https://images.unsplash.com/photo-1471864190281-a93a3070b6de?w=400'
            ],
            [
                'name' => 'Arousal Gel for Women',
                'description' => 'Intimate sensation gel for enhanced arousal',
                'category' => 'Reproductive Wellness',
                'old_price' => 550.00,
                'current_price' => 495.00,
                'discount_percentage' => 10,
                'stock' => 110,
                'image' => 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=400'
            ],
            [
                'name' => 'L-Arginine 1000mg',
                'description' => 'Amino acid supplement for blood flow and stamina',
                'category' => 'Reproductive Wellness',
                'old_price' => 520.00,
                'current_price' => 468.00,
                'discount_percentage' => 10,
                'stock' => 140,
                'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
            ],
            [
                'name' => 'Condoms Extra Large',
                'description' => 'Larger size premium condoms for comfort (Pack of 10)',
                'category' => 'Reproductive Wellness',
                'old_price' => 380.00,
                'current_price' => 342.00,
                'discount_percentage' => 10,
                'stock' => 200,
                'image' => 'https://images.unsplash.com/photo-1583947215259-38e31be8751f?w=400'
            ],
            [
                'name' => 'Horny Goat Weed Extract',
                'description' => 'Traditional herbal supplement for vitality and energy',
                'category' => 'Reproductive Wellness',
                'old_price' => 620.00,
                'current_price' => 558.00,
                'discount_percentage' => 10,
                'stock' => 95,
                'image' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=400'
            ],
            [
                'name' => 'Massage Oil Sensual',
                'description' => 'Warming massage oil with natural aphrodisiac oils',
                'category' => 'Reproductive Wellness',
                'old_price' => 480.00,
                'current_price' => 432.00,
                'discount_percentage' => 10,
                'stock' => 160,
                'image' => 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=400'
            ],
            [
                'name' => 'Zinc + Magnesium Complex',
                'description' => 'Mineral supplement for testosterone production support',
                'category' => 'Reproductive Wellness',
                'old_price' => 420.00,
                'current_price' => 378.00,
                'discount_percentage' => 10,
                'stock' => 175,
                'image' => 'https://images.unsplash.com/photo-1579722820308-d74e571900a9?w=400'
            ],
            [
                'name' => 'Condoms Flavored Variety',
                'description' => 'Assorted flavored condoms for oral pleasure (Pack of 12)',
                'category' => 'Reproductive Wellness',
                'old_price' => 320.00,
                'current_price' => 288.00,
                'discount_percentage' => 10,
                'stock' => 230,
                'image' => 'https://images.unsplash.com/photo-1583947215259-38e31be8751f?w=400'
            ],
            [
                'name' => 'Tribulus Terrestris 1000mg',
                'description' => 'Natural testosterone and athletic performance booster',
                'category' => 'Reproductive Wellness',
                'old_price' => 580.00,
                'current_price' => 522.00,
                'discount_percentage' => 10,
                'stock' => 105,
                'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
            ],
            [
                'name' => 'Silicone Lubricant',
                'description' => 'Long-lasting premium silicone-based intimate lubricant',
                'category' => 'Reproductive Wellness',
                'old_price' => 650.00,
                'current_price' => 585.00,
                'discount_percentage' => 10,
                'stock' => 125,
                'image' => 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?w=400'
            ],
            [
                'name' => 'Female Libido Enhancer',
                'description' => 'Natural herbal blend for women\'s desire and arousal',
                'category' => 'Reproductive Wellness',
                'old_price' => 720.00,
                'current_price' => 648.00,
                'discount_percentage' => 10,
                'stock' => 85,
                'image' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=400'
            ],
            [
                'name' => 'Prostate Support Formula',
                'description' => 'Saw palmetto and zinc for men\'s prostate health',
                'category' => 'Reproductive Wellness',
                'old_price' => 780.00,
                'current_price' => 702.00,
                'discount_percentage' => 10,
                'stock' => 115,
                'image' => 'https://images.unsplash.com/photo-1579722820308-d74e571900a9?w=400'
            ],
            [
                'name' => 'Fertility Support for Men',
                'description' => 'Comprehensive male fertility supplement with antioxidants',
                'category' => 'Reproductive Wellness',
                'old_price' => 850.00,
                'current_price' => 765.00,
                'discount_percentage' => 10,
                'stock' => 95,
                'image' => 'https://images.unsplash.com/photo-1550572017-4814c9a0cc7f?w=400'
            ],
        ];


        foreach ($medicines as $medicine) {
            Medicines::create($medicine);
        }
    }
}