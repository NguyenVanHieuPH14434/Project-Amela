<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attributes';

    protected $fillable = [
        'attr_name',
        'attr_img',
        'attr_desc',
        'parent_id'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        // 'created_at',
    ];

    public function getSubAttribute () {
        return $this->hasMany(Attribute::class, 'parent_id', 'id');
    }
}
