<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'receiver_name',
        'receiver_phone',
        'region',
        'city',
        'area',
        'address',
        'payment_method',
        'cart_totals',
        'status',
    ];

    protected $casts = [
        'cart_totals' => 'array',
    ];

    public function items()
    {
        return $this->hasMany(CustomerOrderItem::class);
    }
}
