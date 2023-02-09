<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'customer',
        'address',
        'code_order',
        'email',
        'phone',
        'note',
        'user_id',
        'status_order',
        'payment_id',
        'total_price',
        'deleted_at',
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        // 'created_at',
    ];

    public function getOrderItem () {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function getStatuss () {
        return $this->belongsTo(OrderStatus::class, 'status_order', 'id');
    }
    
}
