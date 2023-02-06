<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'product_id',
        'attr_id',
        'quantity',
        'deleted_at',
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'created_at',
    ];
}
