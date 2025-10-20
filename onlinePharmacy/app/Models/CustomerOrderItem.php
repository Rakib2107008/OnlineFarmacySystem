<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_order_id',
        'item_id',
        'item_type',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(CustomerOrder::class);
    }
}
