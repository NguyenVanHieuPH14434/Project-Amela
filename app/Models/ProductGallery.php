<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;

    protected $table = 'product_galleries';

    protected $fillable = [
        'product_id',
        'path_image'
    ];

    protected $hidden = [
        // "created_at",
        "updated_at",
    ];
}
