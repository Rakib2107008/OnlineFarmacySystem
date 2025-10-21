<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'receiver_name',
        'receiver_phone',
        'region',
        'city',
        'area',
        'address',
        'payment_method',
        'coupon_code',
        'total_amount',
        'transaction_id',
        'status',
        'payment_status',
    ];

    /**
     * Get the items for the order
     */
    public function items()
    {
        return $this->hasMany(CustomerOrderItem::class);
    }

    /**
     * Get the total amount formatted
     */
    public function getFormattedTotalAttribute()
    {
        return '৳ ' . number_format($this->total_amount, 2);
    }
}
