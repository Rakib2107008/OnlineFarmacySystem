<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    // Table name (optional — Laravel auto-detects "offers")
    protected $table = 'offers';

    // Primary key (optional — default is "id")
    protected $primaryKey = 'id';

    // Fields that can be mass-assigned
    protected $fillable = [
        'title',
        'description',
        'image',
        'button_text',
    ];

    // If you don't want timestamps, uncomment this:
    // public $timestamps = false;
}
