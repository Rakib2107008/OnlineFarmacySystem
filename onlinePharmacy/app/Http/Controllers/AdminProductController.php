<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Products::orderBy('id', 'desc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'current_price' => 'required|numeric|min:0',
            'old_price' => 'required|numeric|min:0',
            'discount_percentage' => 'required|integer|min:0|max:100',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Create public/Images directory if it doesn't exist
            $imageDirectory = public_path('Images');
            if (!file_exists($imageDirectory)) {
                mkdir($imageDirectory, 0777, true);
            }
            
            // Move image to public/Images folder
            $image->move($imageDirectory, $imageName);
            
            // Create the image URL path for database (accessible via web)
            $imagePath = 'Images/' . $imageName;
        }

        // Create product
        Products::create([
            'name' => $request->name,
            'image' => $imagePath,
            'current_price' => $request->current_price,
            'old_price' => $request->old_price,
            'discount_percentage' => $request->discount_percentage,
            'description' => $request->description,
            'category' => $request->category,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = Products::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Products::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'current_price' => 'required|numeric|min:0',
            'old_price' => 'required|numeric|min:0',
            'discount_percentage' => 'required|integer|min:0|max:100',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
        ]);

        $imagePath = $product->image;

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Create public/Images directory if it doesn't exist
            $imageDirectory = public_path('Images');
            if (!file_exists($imageDirectory)) {
                mkdir($imageDirectory, 0777, true);
            }
            
            // Move image to public/Images folder
            $image->move($imageDirectory, $imageName);
            
            // Create the image URL path for database (accessible via web)
            $imagePath = 'Images/' . $imageName;
        }

        // Update product
        $product->update([
            'name' => $request->name,
            'image' => $imagePath,
            'current_price' => $request->current_price,
            'old_price' => $request->old_price,
            'discount_percentage' => $request->discount_percentage,
            'description' => $request->description,
            'category' => $request->category,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $product = Products::findOrFail($id);

        // Delete image file if exists
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
