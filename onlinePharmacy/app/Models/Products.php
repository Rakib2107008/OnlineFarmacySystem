<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    // Explicitly set the table name
    protected $table = 'products';

    // ✅ Allow mass assignment for these fields
    protected $fillable = [
        'name',
        'image',
        'current_price',
        'old_price',
        'discount_percentage',
        'description',
        'category',
        'quantity',
    ];

    // ✅ Enable timestamps
    public $timestamps = true;
}
