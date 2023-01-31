<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'cate_name',
        'cate_image',
        'cate_desc',
        'parent_id',
        'deleted_at'
    ];

    public function cate_product () {
        return $this->belongsToMany(Product::class, 'categories_products', 'cate_id', 'product_id')->withPivot('cate_id', 'product_id', 'created_at');
    }

    public function getChildrenCateogory () {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
