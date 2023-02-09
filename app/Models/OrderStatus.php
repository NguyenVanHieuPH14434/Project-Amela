<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'order_status';

    protected $fillable = [
        'status_name',
        'deleted_at',
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
    ];
}
