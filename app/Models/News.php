<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $fillable = [
        'new_title',
        'new_content',
        'deleted_at',
    ];

    public function getCateNew () {
        return $this->belongsToMany(CategoryNew::class, 'news_categories_has_news', 'new_id', 'new_category_id');
    }
}
