<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAuth extends Model
{
    protected $table = 'customers_auth';
    
    protected $fillable = [
        'name',
        'phone',
        'password',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
