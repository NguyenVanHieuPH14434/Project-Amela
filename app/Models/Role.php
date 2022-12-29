<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
        'role_key',
        'role_description',
        'deleted_at'
    ];

    public function permission_role (){
        return $this->belongsToMany(Permission::class, 'roles_permissions', 'role_id', 'pms_id')->withPivot('role_id', 'pms_id', 'id');
    }
}
