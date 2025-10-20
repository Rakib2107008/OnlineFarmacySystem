<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicines;
use App\Models\Products;

class CartController extends Controller
{
    /**
     * Display the cart page
     */
    public function index()
    {
        return view('cart');
    }

    /**
     * Get cart item details by ID and type
     */
    public function getItem(Request $request)
    {
        $id = $request->input('id');
        $rawTableType = strtolower((string) $request->input('tableType'));

        if (!$id || !$rawTableType) {
            return response()->json(['error' => 'Invalid parameters'], 400);
        }

        $tableType = $this->normaliseTableType($rawTableType);
        if (!$tableType) {
            return response()->json(['error' => 'Unsupported table type'], 400);
        }

        $item = $tableType === 'medicines'
            ? Medicines::find($id)
            : Products::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        $price = $item->current_price ?? $item->price ?? $item->selling_price ?? 0;
        $stock = $tableType === 'medicines'
            ? (int) ($item->stock ?? 0)
            : (int) ($item->quantity ?? 0);

        $imagePath = $item->image ?? null;
        $imageUrl = $imagePath ? asset($imagePath) : null;

        return response()->json([
            'id' => $item->id,
            'tableType' => $tableType,
            'name' => $item->name,
            'price' => (float) $price,
            'current_price' => (float) $price,
            'old_price' => (float) ($item->old_price ?? 0),
            'stock' => $stock,
            'image' => $imagePath,
            'image_path' => $imagePath,
            'image_url' => $imageUrl,
        ]);
    }

    private function normaliseTableType(string $value): ?string
    {
        $value = strtolower(trim($value));

        if ($value === 'products' || $value === 'product' || str_contains($value, 'product')) {
            return 'products';
        }

        if ($value === 'medicines' || $value === 'medicine' || str_contains($value, 'medicine')) {
            return 'medicines';
        }

        return null;
    }
}
