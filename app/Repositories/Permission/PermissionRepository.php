<?php

namespace App\Repositories\Permission;

use App\Constant\Constanst;
use App\Models\OrderItem;
use App\Models\Permission;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface {

    public function getModel()
    {
        return Permission::class;
    }

    public function getAllPermission()
    {
        return $this->model->where('parent_id', Constanst::PARENT)->get();
    }

    public function getPermission($paginate = Constanst::LIMIT_PERPAG)
    {
        $columns = ['pms_name', 'created_at', 'id'];
        $data = $this->model->where('parent_id', Constanst::PARENT)
        ->where(function($q) use($columns) {
            scopeFilter($q, $columns);
        });

        $result = $data->orderBY(sortBy($columns),sortOrder())->paginate($paginate);
        return $result;
    }  
    
    public function insertPermission($pmsName, $pmsKey=' ', $parentId=Constanst::PARENT)
    {
        $action = new $this->model();
        $action->pms_name = $pmsName;
        $action->pms_key = $pmsKey;
        $action->parent_id = $parentId;
        $action->save();
        return $action->id;
    }

    public function updatePermission($id, $pmsName)
    {
        $pms = $this->model->findOrFail($id);
        $pms->pms_name = $pmsName;
        $pms->pms_key = ' ';
        $pms->parent_id = Constanst::PARENT;
        $pms->update();
        $pms->getChildrentPermission()->delete();
        return $pms->id;
    }

    public function deletePermission($id)
    {
        $pmsParent = $this->model->find($id);
        $getPmsChil = $pmsParent->getChildrentPermission;
        foreach($getPmsChil as $it){
            DB::table('roles_permissions')->where('pms_id', $it->id)->delete();
        }
        $pmsParent->delete();
    }

    public function searchPermission($key, $columns = [])
    {
        $data = $this->model->where('parent_id', Constanst::PARENT);

        if($key != ''){
            $data->where(querySearchByColumns($columns, trim($key)));
        }

        $result = $data->paginate(Constanst::LIMIT_PERPAG);
        return $result;
    }
}