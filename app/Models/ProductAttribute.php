<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $table = 'products_attributes';
    protected $fillable = [
        'size_id',
        'color_id',
        'product_id',
        'stock',
        'price'
    ];
}
