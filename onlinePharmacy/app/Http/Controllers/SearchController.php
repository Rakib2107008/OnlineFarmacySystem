<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicines;
use App\Models\Products;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        if (!$query) {
            return redirect()->back();
        }

        // Search in medicines with priority ordering
        // Priority: 1. Name match, 2. Category match, 3. Description match
        $medicines = Medicines::where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('category', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->orderByRaw("
                CASE 
                    WHEN name LIKE ? THEN 1
                    WHEN category LIKE ? THEN 2
                    WHEN description LIKE ? THEN 3
                    ELSE 4
                END
            ", ["%{$query}%", "%{$query}%", "%{$query}%"])
            ->paginate(12);

        // Search in products with same priority ordering
        $products = Products::where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('category', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->orderByRaw("
                CASE 
                    WHEN name LIKE ? THEN 1
                    WHEN category LIKE ? THEN 2
                    WHEN description LIKE ? THEN 3
                    ELSE 4
                END
            ", ["%{$query}%", "%{$query}%", "%{$query}%"])
            ->paginate(12);

        return view('searchResults', compact('medicines', 'products', 'query'));
    }
}
