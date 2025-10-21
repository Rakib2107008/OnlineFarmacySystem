<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_order_id',
        'product_id',
        'medicine_id',
        'quantity',
        'price',
        'total',
    ];

    /**
     * Get the order that owns the item
     */
    public function order()
    {
        return $this->belongsTo(CustomerOrder::class, 'customer_order_id');
    }

    /**
     * Get the product (if applicable)
     */
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    /**
     * Get the medicine (if applicable)
     */
    public function medicine()
    {
        return $this->belongsTo(Medicines::class, 'medicine_id');
    }

    /**
     * Get the item name (product or medicine)
     */
    public function getItemNameAttribute()
    {
        if ($this->product) {
            return $this->product->name;
        }
        if ($this->medicine) {
            return $this->medicine->name;
        }
        return 'Unknown Item';
    }
}
