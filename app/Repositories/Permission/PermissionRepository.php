<?php

namespace App\Repositories\Permission;

use App\Constant\Constanst;
use App\Models\OrderItem;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface {

    public function getModel()
    {
        return OrderItem::class;
    }

    public function getAllPermission()
    {
        return $this->model->where('parent_id', Constanst::PARENT)->get();
    }

    public function getPermission($req = null, $paginate = Constanst::LIMIT_PERPAG)
    {
        $data = $this->model->where('parent_id', Constanst::PARENT);
        $colums = ['pms_name'];

        if($req != null && $req->keyword){
            $data->where(querySearchByColumns($colums, $req->keyword));
        }
        $sortOrder = sortOrder($req != null && $req->sortOrder??$req->sortOrder);

        $result = $data->orderBY('id',$sortOrder)->paginate($paginate);
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