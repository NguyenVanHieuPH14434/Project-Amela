<?php

namespace App\Services;

use App\Constant\Constanst;
use App\Models\Permission;
use App\Models\Role;

class RoleService {

    public function getAllRole () {
        return Role::with('permission_role')->where('deleted_at', null)->get();
    }

    public function getPaginateRole ($paginate = Constanst::LIMIT_PERPAG) {
        return  Role::with('permission_role')->where('deleted_at', null)->paginate($paginate);
    }

    public function deleteRole ($id){
        $role = Role::findOrFail($id);
        $role->permission_role()->detach();
        $role->delete();
    }

    public function searchRole ($textSearch) {
        $key = trim($textSearch);
        $requestData = ['role_name'];
        $listRole;
        if($key != ''){
            $listRole = Role::where('deleted_at', null)->where(querySearchByColumns($requestData, $key))
            ->paginate(10);
        }else{
            $listRole = $this->getPaginateRole();
        }
        return $listRole;
    }

}
