<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_image',
        'product_price',
        'is_active',
        'product_inventory',
        'product_short_desc',
        'product_desc',
        'deleted_at'
    ];
}
