<?php

namespace App\Services;

use App\Policies\AttributePolicy;
use App\Policies\CategoryPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\ProductPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;

class DefinePolicy{

    public function permissionDefine () {
        Gate::define('list-pms', [PermissionPolicy::class, 'view']);
        Gate::define('add-pms', [PermissionPolicy::class, 'create']);
        Gate::define('edit-pms', [PermissionPolicy::class, 'update']);
        Gate::define('delete-pms', [PermissionPolicy::class, 'delete']);
    }

    public function roleDefine () {
        Gate::define('list-role', [RolePolicy::class, 'view']);
        Gate::define('add-role', [RolePolicy::class, 'create']);
        Gate::define('edit-role', [RolePolicy::class, 'update']);
        Gate::define('delete-role', [RolePolicy::class, 'delete']);
    }

    public function categoryDefine () {
        Gate::define('list-cate', [CategoryPolicy::class, 'view']);
        Gate::define('add-cate', [CategoryPolicy::class, 'create']);
        Gate::define('edit-cate', [CategoryPolicy::class, 'update']);
        Gate::define('delete-cate', [CategoryPolicy::class, 'delete']);
    }

    public function userDefine () {
        Gate::define('list-user', [UserPolicy::class, 'view']);
        Gate::define('add-user', [UserPolicy::class, 'create']);
        Gate::define('edit-user', [UserPolicy::class, 'update']);
        Gate::define('delete-user', [UserPolicy::class, 'delete']);
    }

    public function attributeDefine () {
        Gate::define('list-attr', [AttributePolicy::class, 'view']);
        Gate::define('add-attr', [AttributePolicy::class, 'create']);
        Gate::define('edit-attr', [AttributePolicy::class, 'update']);
        Gate::define('delete-attr', [AttributePolicy::class, 'delete']);
    }

    public function productDefine () {
        Gate::define('list-product', [ProductPolicy::class, 'view']);
        Gate::define('add-product', [ProductPolicy::class, 'create']);
        Gate::define('edit-product', [ProductPolicy::class, 'update']);
        Gate::define('delete-product', [ProductPolicy::class, 'delete']);
    }
}
