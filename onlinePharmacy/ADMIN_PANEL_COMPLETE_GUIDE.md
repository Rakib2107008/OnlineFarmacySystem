# Admin Panel - Complete Setup Guide

## ✅ What Has Been Created

### Controllers
1. **AdminProductController.php** - Manages all product CRUD operations
2. **ImageController.php** - Serves images from D:\images directory

### Views
1. **admin/layout.blade.php** - Main admin panel layout
2. **admin/products/index.blade.php** - Products list with table
3. **admin/products/create.blade.php** - Add new product form
4. **admin/products/edit.blade.php** - Edit product form

### Routes
Updated `routes/web.php` with:
- Admin product routes
- Image serving route

## 🎯 Image Storage Configuration

### Storage Location: `D:\images`

All product images are stored in `D:\images` directory on your D: drive.

### How It Works:
1. **Upload**: User selects image from file explorer
2. **Storage**: Image saved to `D:\images\{timestamp}_{uniqueid}.{ext}`
3. **Database**: Full path stored as `D:\images\{filename}`
4. **Display**: Images served via route `/images/{filename}`

### Example:
- File location: `D:\images\1697123456_abc123.jpg`
- Database value: `D:\images\1697123456_abc123.jpg`
- Display URL: `http://localhost:8000/images/1697123456_abc123.jpg`

## 🚀 How to Access Admin Panel

### Option 1: Using php artisan serve
```bash
cd c:\xampp\htdocs\Pharmacy\OnlineFarmacySystem\onlinePharmacy
php artisan serve
```
Then visit: **http://127.0.0.1:8000/admin/products**

### Option 2: Using XAMPP
Make sure Apache is running in XAMPP, then visit:
**http://localhost/Pharmacy/OnlineFarmacySystem/onlinePharmacy/public/admin/products**

## 📋 Features

### ✅ Products List Page
- View all products in a sortable table
- Display product thumbnails from D:\images
- Show: ID, Name, Category, Prices, Discount %
- Edit (yellow button) and Delete (red button) for each product
- "Add New Product" button at top
- Pagination (10 products per page)
- Success/error message alerts

### ✅ Add Product
- Complete form with all fields
- **Image Upload**: Click to browse D:\ drive or any folder
- **Live Preview**: See image before saving
- **Auto-calculate**: Discount % calculated from prices
- **Categories**: Dropdown with 7 categories
- Image saved to: `D:\images\`
- Database stores: `D:\images\filename.jpg`

### ✅ Edit Product
- Pre-filled form with existing data
- Shows current image from D:\images
- Upload new image (optional)
- Old image deleted when new one uploaded
- All fields editable

### ✅ Delete Product
- Confirmation dialog before deletion
- Removes from database
- Deletes image file from D:\images

## 🎨 Admin Panel Features

### Sidebar Menu:
- Dashboard (placeholder)
- **Products** (active)
- Categories (placeholder)
- Orders (placeholder)
- Customers (placeholder)
- View Website (link to homepage)

### Top Bar:
- Page title
- Admin user info
- Logout button (placeholder)

## 📝 All Routes

| Method | URL | Description |
|--------|-----|-------------|
| GET | /admin/products | List all products |
| GET | /admin/products/create | Add product form |
| POST | /admin/products | Save new product |
| GET | /admin/products/{id}/edit | Edit product form |
| PUT | /admin/products/{id} | Update product |
| DELETE | /admin/products/{id} | Delete product |
| GET | /images/{filename} | Serve image from D:\images |

## 🧪 Testing Instructions

### Step 1: Start Server
```bash
cd c:\xampp\htdocs\Pharmacy\OnlineFarmacySystem\onlinePharmacy
php artisan serve
```

### Step 2: Access Admin Panel
Open browser: `http://127.0.0.1:8000/admin/products`

### Step 3: Test Add Product
1. Click "Add New Product" button
2. Fill in product name: "Test Product"
3. Select category: "Medicines"
4. Click "Choose File" for image
5. Browse to **any folder** on your computer
6. Select an image (JPG, PNG, GIF, WEBP)
7. See live preview appear
8. Enter old price: 1000
9. Enter current price: 800
10. Notice discount auto-calculates to 20%
11. Enter description
12. Click "Save Product"
13. Product appears in list with thumbnail

### Step 4: Verify Image Storage
1. Open Windows Explorer
2. Navigate to `D:\images`
3. See your uploaded image with timestamp filename
4. Example: `1697123456_abc123def.jpg`

### Step 5: Test Edit Product
1. Click yellow edit button on any product
2. See current image displayed from D:\images
3. Modify product name
4. Optionally upload new image
5. Click "Update Product"
6. Old image deleted, new image saved to D:\images

### Step 6: Test Delete Product
1. Click red delete button
2. Confirm deletion in popup
3. Product removed from database
4. Image file deleted from D:\images

## 🔧 Important Files Modified

### Controller Updates:
```php
// Store images to D:\images
$imageDirectory = 'D:\images';
$image->move($imageDirectory, $imageName);
$imagePath = 'D:\images\\' . $imageName;
```

### Image Display:
```blade
@php
    $imageName = basename($product->image);
@endphp
<img src="{{ route('image.show', $imageName) }}" alt="{{ $product->name }}">
```

## 📂 Directory Structure

```
D:\images\                          ← Your images stored here
├── 1697123456_abc123.jpg
├── 1697123789_def456.png
└── ...

c:\xampp\htdocs\Pharmacy\OnlineFarmacySystem\onlinePharmacy\
├── app\
│   └── Http\
│       └── Controllers\
│           ├── AdminProductController.php  ← Product CRUD
│           └── ImageController.php         ← Serve images
├── resources\
│   └── views\
│       └── admin\
│           ├── layout.blade.php           ← Admin layout
│           └── products\
│               ├── index.blade.php        ← List page
│               ├── create.blade.php       ← Add page
│               └── edit.blade.php         ← Edit page
└── routes\
    └── web.php                            ← All routes
```

## 🎯 Categories Available

1. Medicines
2. Diabetic Care
3. Personal Care
4. Sexual Wellbeing
5. Vitamin & Supplements
6. Women Care
7. Baby & Mom

## ⚙️ Form Validation Rules

- **Name**: Required, max 255 characters
- **Image**: Required (create), Optional (edit), JPG/PNG/GIF/WEBP, Max 2MB
- **Current Price**: Required, numeric, minimum 0
- **Old Price**: Required, numeric, minimum 0
- **Discount**: Required, integer, 0-100%
- **Description**: Required, text
- **Category**: Required, from dropdown

## 💡 Special Features

✅ **Auto-calculate Discount**: When you enter old and current price, discount % calculates automatically

✅ **Live Image Preview**: See your image before saving

✅ **Smart Image Management**: Old images automatically deleted when updating or deleting products

✅ **File Browser Integration**: Click "Choose File" to browse any folder on your computer including D:\ drive

✅ **Unique Filenames**: Each image gets timestamp + random ID to prevent conflicts

✅ **Responsive Design**: Works on desktop, tablet, and mobile

## 🔍 Troubleshooting

### Problem: Can't create D:\images directory
**Solution**: Manually create the folder:
1. Open Windows Explorer
2. Go to D:\ drive
3. Create new folder named "images"

### Problem: Images not displaying
**Solution**: Check if:
1. Image file exists in D:\images
2. Filename in database matches actual file
3. ImageController is working: visit `/images/{filename}` directly

### Problem: Upload fails
**Solution**: Check PHP upload limits in `php.ini`:
```ini
upload_max_filesize = 2M
post_max_size = 2M
```

### Problem: Permission denied
**Solution**: Give write permissions to D:\images folder:
1. Right-click D:\images folder
2. Properties → Security
3. Edit → Add write permissions

## 🎉 You're Ready!

Your admin panel is fully set up with:
- ✅ Product listing
- ✅ Add products with image upload to D:\images
- ✅ Edit products with optional new image
- ✅ Delete products (removes image file too)
- ✅ Beautiful UI with Bootstrap 5
- ✅ Form validation
- ✅ Success/error messages
- ✅ Image preview
- ✅ Auto-calculate discount

**Start managing your pharmacy products now!** 🚀
