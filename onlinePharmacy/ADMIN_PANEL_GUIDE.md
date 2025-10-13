# Admin Panel Setup Guide

## ✅ Files Created

### Controllers
- `app/Http/Controllers/AdminProductController.php` - Handles all product CRUD operations

### Views
- `resources/views/admin/layout.blade.php` - Admin panel layout
- `resources/views/admin/products/index.blade.php` - Products list page
- `resources/views/admin/products/create.blade.php` - Add new product page
- `resources/views/admin/products/edit.blade.php` - Edit product page

### Routes
Updated `routes/web.php` with admin routes

## 🚀 How to Access

### Admin Panel URL:
```
http://localhost/Pharmacy/OnlineFarmacySystem/onlinePharmacy/public/admin/products
```

Or if using `php artisan serve`:
```
http://127.0.0.1:8000/admin/products
```

## 📋 Features Implemented

### ✅ Products List Page
- View all products in a table
- Product image thumbnails
- Display: ID, Name, Category, Prices, Discount
- Pagination (10 products per page)
- Edit and Delete buttons for each product
- "Add New Product" button

### ✅ Add Product Page
- Form to create new products
- Image upload from file explorer
- Live image preview before upload
- Auto-calculate discount percentage
- Categories dropdown
- Form validation
- Image stored in `public/Images/` folder
- Image path saved to database

### ✅ Edit Product Page
- Pre-filled form with existing product data
- Shows current product image
- Option to upload new image (keeps old if not changed)
- Updates all product information
- Deletes old image when new one is uploaded

### ✅ Delete Product
- Delete confirmation dialog
- Removes product from database
- Deletes associated image file from server

## 🎨 Image Upload System

### How It Works:
1. User selects image from file explorer
2. Image is validated (JPG, PNG, GIF, WEBP, Max 2MB)
3. Image preview shown before saving
4. On save:
   - Unique filename generated (timestamp + random ID)
   - Image moved to `public/Images/` folder
   - Path saved as `Images/filename.ext` in database
5. On edit:
   - Old image deleted if new one uploaded
   - New image saved with unique name
6. On delete:
   - Product record removed from database
   - Associated image file deleted from server

## 📝 Routes Available

| Method | URL | Description |
|--------|-----|-------------|
| GET | /admin/products | List all products |
| GET | /admin/products/create | Show add product form |
| POST | /admin/products | Store new product |
| GET | /admin/products/{id}/edit | Show edit form |
| PUT | /admin/products/{id} | Update product |
| DELETE | /admin/products/{id} | Delete product |

## 🔧 Testing Steps

1. **Start your server:**
   ```bash
   php artisan serve
   ```

2. **Access admin panel:**
   Navigate to: `http://127.0.0.1:8000/admin/products`

3. **Test Add Product:**
   - Click "Add New Product" button
   - Fill in all fields
   - Select an image from your computer
   - See live preview
   - Click "Save Product"
   - Verify product appears in list

4. **Test Edit Product:**
   - Click edit button (yellow) on any product
   - Modify fields
   - Optionally upload new image
   - Click "Update Product"
   - Verify changes saved

5. **Test Delete Product:**
   - Click delete button (red) on any product
   - Confirm deletion
   - Verify product removed from list
   - Check that image file was deleted from `public/Images/`

## 📂 Image Storage Location

All uploaded images are stored in:
```
public/Images/
```

Image paths in database are stored as:
```
Images/1697123456_abc123.jpg
```

To display images in Blade templates:
```blade
<img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
```

## 🎯 Categories Available

1. Medicines
2. Diabetic Care
3. Personal Care
4. Sexual Wellbeing
5. Vitamin & Supplements
6. Women Care
7. Baby & Mom

## 💡 Features

- ✅ Image upload with preview
- ✅ Auto-calculate discount percentage
- ✅ Form validation
- ✅ Success/Error messages
- ✅ Pagination
- ✅ Delete confirmation
- ✅ Responsive design
- ✅ Beautiful UI with Bootstrap 5
- ✅ Font Awesome icons
- ✅ Image file management (delete old on update/delete)

## 🔍 Troubleshooting

### Images not showing?
Make sure the `public/Images` directory exists and has write permissions:
```bash
mkdir public/Images
chmod 755 public/Images
```

### Upload not working?
Check your PHP upload limits in `php.ini`:
```ini
upload_max_filesize = 2M
post_max_size = 2M
```

### Routes not found?
Clear route cache:
```bash
php artisan route:clear
php artisan route:cache
```
