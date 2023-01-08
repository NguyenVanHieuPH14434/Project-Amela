<?php

namespace App\Services;

use App\Models\Permission;

class PermissionService {

    public function getAllPermission () {
        return Permission::where('parent_id', 0)->get();
    }

    public function getPaginatePermission ($paginate = 10) {
        return  Permission::where('parent_id', 0)->paginate($paginate);
    }

     public function insertPermission ($pmsName, $pmsKey=' ', $parentId=0) {
            $action = new Permission();
            $action->pms_name = $pmsName;
            $action->pms_key = $pmsKey;
            $action->parent_id = $parentId;
            $action->save();
            return $action->id;
    }

     public function updatepParentPermission ($id, $pmsName) {
            $pms = Permission::findOrFail($id);
            $pms->pms_name = $pmsName;
            $pms->pms_key = ' ';
            $pms->parent_id = 0;
            $pms->update();
            $pms->getChildrentPermission()->delete();
            return $pms->id;
    }
}
