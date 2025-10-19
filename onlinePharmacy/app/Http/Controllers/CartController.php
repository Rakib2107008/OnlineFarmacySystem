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
        $tableType = $request->input('tableType');

        if (!$id || !$tableType) {
            return response()->json(['error' => 'Invalid parameters'], 400);
        }

        $item = null;

        if ($tableType === 'medicines') {
            $item = Medicines::find($id);
        } elseif ($tableType === 'products') {
            $item = Products::find($id);
        }

        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        return response()->json([
            'id' => $item->id,
            'name' => $item->name,
            'price' => $item->price ?? $item->selling_price,
            'image' => $item->image ?? null,
            'tableType' => $tableType
        ]);
    }
}
