<?php

namespace App\Http\Controllers;

use App\Models\Medicines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MedicineController extends Controller
{
    /**
     * Display a listing of the medicines.
     */
    public function index(Request $request)
    {
        $category = $request->get('category', 'Medicines'); // Default to 'Medicines'
        
        $medicines = Medicines::where('category', $category)
            ->orderBy('id', 'desc')
            ->paginate(10);
        
        return view('admin.catagories.index', compact('medicines', 'category'));
    }

    /**
     * Show the form for creating a new medicine.
     */
    public function create()
    {
        return view('admin.catagories.create');
    }

    /**
     * Store a newly created medicine in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'old_price' => 'required|numeric|min:0',
            'current_price' => 'required|numeric|min:0',
            'discount_percentage' => 'required|integer|min:0|max:100',
            'stock' => 'required|integer|min:0',
        ]);

        $imagePath = null;

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

        // Create medicine
        Medicines::create([
            'name' => $request->name,
            'image' => $imagePath,
            'description' => $request->description,
            'category' => $request->category,
            'old_price' => $request->old_price,
            'current_price' => $request->current_price,
            'discount_percentage' => $request->discount_percentage,
            'stock' => $request->stock,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Medicine created successfully!');
    }

    /**
     * Display the specified medicine.
     */
    public function show($id)
    {
        $medicines = Medicines::findOrFail($id);
        return view('admin.catagories.show', compact('medicines'));
    }

    /**
     * Show the form for editing the specified medicine.
     */
    public function edit($id)
    {
        $medicines = Medicines::findOrFail($id);
        return view('admin.catagories.edit', compact('medicines'));
    }

    /**
     * Update the specified medicine in storage.
     */
    public function update(Request $request, $id)
    {
        $medicines = Medicines::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'old_price' => 'required|numeric|min:0',
            'current_price' => 'required|numeric|min:0',
            'discount_percentage' => 'required|integer|min:0|max:100',
            'stock' => 'required|integer|min:0',
        ]);

        $imagePath = $medicines->image;

        // Handle new image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($medicines->image && file_exists(public_path($medicines->image))) {
                unlink(public_path($medicines->image));
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

        // Update medicine
        $medicines->update([
            'name' => $request->name,
            'image' => $imagePath,
            'description' => $request->description,
            'category' => $request->category,
            'old_price' => $request->old_price,
            'current_price' => $request->current_price,
            'discount_percentage' => $request->discount_percentage,
            'stock' => $request->stock,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Medicine updated successfully!');
    }

    /**
     * Remove the specified medicine from storage.
     */
    public function destroy($id)
    {
        $medicines = Medicines::findOrFail($id);

        // Delete image file if exists
        if ($medicines->image && file_exists(public_path($medicines->image))) {
            unlink(public_path($medicines->image));
        }

        $medicines->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Medicine deleted successfully!');
    }

    /**
     * Display medicines on the public-facing page.
     */
    public function publicIndex()
    {
        $medicines = Medicines::where('stock', '>', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(12);
        
        return view('medicines', compact('medicines'));
    }

    /**
     * Search medicines (for AJAX requests).
     */
    public function search(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');

        $medicines = Medicines::query();

        if ($query) {
            $medicines->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            });
        }

        if ($category) {
            $medicines->where('category', $category);
        }

        $medicines = $medicines->where('stock', '>', 0)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return response()->json([
            'success' => true,
            'medicines' => $medicines
        ]);
    }
}