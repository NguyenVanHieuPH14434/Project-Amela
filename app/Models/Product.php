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
        // 'product_price',
        'is_active',
        // 'product_inventory',
        'product_short_desc',
        'product_desc',
        'deleted_at'
    ];

    public function productGallery () {
        return $this->hasMany(ProductGallery::class, 'product_id', 'id');
    }

    public function categoryProduct () {
        return $this->belongsToMany(Category::class, 'categories_products', 'product_id', 'cate_id');
    }

    public function attributeProduct () {
        return $this->belongsToMany(Attribute::class, 'products_attributes', 'product_id', 'attr_id')->withPivot('product_id', 'attr_id', 'price', 'stock');
    }
}
