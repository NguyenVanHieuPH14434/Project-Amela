<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'pms_name',
        'pms_key',
        'parent_id'
    ];


    public function getChildrentPermission()
    {
        return $this->hasMany(Permission::class, 'parent_id', 'id');
    }
}
