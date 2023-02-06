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
}
