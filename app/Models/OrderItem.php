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

    public function getProduct () {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function getAttr () {
        return $this->belongsTo(Attribute::class, 'attr_id', 'id');
    }

    public function getOrder () {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
