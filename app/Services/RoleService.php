<?php

namespace App\Services;

use App\Models\Permission;
use App\Models\Role;

class RoleService {

    public function getAllRole () {
        return Role::with('permission_role')->where('deleted_at', null)->get();
    }

    public function getPaginateRole ($paginate = 10) {
        return  Role::with('permission_role')->where('deleted_at', null)->paginate($paginate);
    }

}
