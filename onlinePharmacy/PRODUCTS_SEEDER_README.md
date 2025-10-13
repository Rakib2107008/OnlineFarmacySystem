# Products Seeder - Reference Guide

## Created Files
1. `database/seeders/ProductsTableSeeder.php` - Contains all 8 products from the welcome page
2. Updated `database/seeders/DatabaseSeeder.php` - Calls the ProductsTableSeeder

## Products Data Summary

| # | Product Name | Image | Current Price | Old Price | Discount |
|---|--------------|-------|---------------|-----------|----------|
| 1 | Vitamin D3 Supplement - 5000 IU | Images/calsium-magnesium 120 | ৳480 | ৳600 | 20% OFF |
| 2 | Omega-3 Fish Oil - 1000mg | Unsplash URL | ৳850 | ৳1000 | 15% OFF |
| 3 | Multivitamin Complex - 60 Tablets | Unsplash URL | ৳675 | ৳900 | 25% OFF |
| 4 | Calcium + Magnesium - 120 Capsules | Unsplash URL | ৳720 | ৳800 | 10% OFF |
| 5 | Probiotic Supplement - 30 Billion CFU | Unsplash URL | ৳1050 | ৳1500 | 30% OFF |
| 6 | Zinc Supplement - 50mg | Unsplash URL | ৳410 | ৳500 | 18% OFF |
| 7 | Iron Supplement - 65mg | Unsplash URL | ৳390 | ৳500 | 22% OFF |
| 8 | B-Complex Vitamin - 100 Tablets | Unsplash URL | ৳528 | ৳600 | 12% OFF |

## How to Run the Seeder

### Option 1: Run all seeders
```bash
php artisan db:seed
```

### Option 2: Run only the ProductsTableSeeder
```bash
php artisan db:seed --class=ProductsTableSeeder
```

### Option 3: Fresh migration with seeding
```bash
php artisan migrate:fresh --seed
```

## Database Structure
The products are stored with the following fields:
- `id` - Auto increment primary key
- `name` - Product name
- `image` - Image URL or path
- `current_price` - Current selling price (decimal)
- `old_price` - Original price before discount (decimal)
- `discount_percentage` - Discount percentage (integer)
- `description` - Product description
- `category` - Product category (all set to "Vitamin & Supplements")
- `created_at` - Timestamp
- `updated_at` - Timestamp

## Notes
- All products are categorized as "Vitamin & Supplements"
- Descriptions are auto-generated based on product names
- Image paths are preserved as shown in the welcome.blade.php file
- Discount percentages are calculated from the original and sale prices
