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

    protected $hidden = [
        'deleted_at',
        'updated_at',
        // 'created_at',
    ];

    public function getNew () {
        return $this->belongsToMany(News::class, 'news_categories_has_news', 'new_category_id', 'new_id');
    }
}
