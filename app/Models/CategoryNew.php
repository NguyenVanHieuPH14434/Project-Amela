<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryNew extends Model
{
    use HasFactory;
    protected $table = 'new_categories';
    protected $fillable = [
        'new_cate_name',
        'new_cate_image',
        'deleted_at',
    ];
}
