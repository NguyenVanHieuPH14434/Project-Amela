<?php

namespace App\Services;

use App\Models\Permission;
use Illuminate\Support\Facades\DB;

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

    public function deletePermission ($id) {
        $pmsParent = Permission::find($id);
        $getPmsChil = $pmsParent->getChildrentPermission;
        foreach($getPmsChil as $it){
            DB::table('roles_permissions')->where('pms_id', $it->id)->delete();
        }
        $pmsParent->delete();
    }

    public function searchPermission ($textSearch) {
        $key = trim($textSearch);
        $requestData = ['pms_name'];
        $listPermission;
        if($key != ''){
            $listPermission = Permission::where('parent_id', 0)->where(querySearchByColumns($requestData, $key))
            ->paginate(10);
        }else{
            $listPermission = $this->getPaginatePermission();
        }
        return $listPermission;
    }
}
