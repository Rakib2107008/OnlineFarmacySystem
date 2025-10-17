<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicines extends Model
{
    use HasFactory;

    protected $table = 'medicines';

    protected $fillable = [
        'name','category',
        'image',
        'current_price',
        'old_price',
        'discount_percentage',
        'description',
        'stock',
        
    ];
     public $timestamps = true;
}