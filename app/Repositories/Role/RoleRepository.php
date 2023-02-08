<?php

namespace App\Repositories\Role;

use App\Constant\Constanst;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Support\Str;
use App\Repositories\BaseRepository;


class RoleRepository extends BaseRepository implements RoleRepositoryInterface {

    public function getModel()
    {
        return Role::class;
    }

    public function getAllRole()
    {
        return $this->model->where('deleted_at', null)->get();
    }

    public function getRole($req = null, $paginate = Constanst::LIMIT_PERPAG)
    {
        $columns = ['role_name', 'created_at', 'id'];
        $data = $this->model->with(['permission_role'])
        ->where('deleted_at', null)->where(function($q) use($columns) {
            scopeFilter($q, $columns);
        });

        $result = $data->orderBY(sortBy($columns),sortOrder())->paginate($paginate);
        return $result;
    }

    public function insertRole($req)
    {
         $role = new $this->model();
         $role->fill($req->all());
         $role->role_key = Str::lower($req->role_name);
         $role->save();

         $role->permission_role()->attach($req->permission_id);
    }

    public function updateRole($req, $id)
    {
        $role = $this->model->findOrFail($id);
        $role->fill($req->all());
        $role->role_key = Str::lower($req->role_name);
        $role->update();
        $role->permission_role()->sync($req->permission_id);
    }

    public function deleteRole($id)
    {
        $role = $this->model->findOrFail($id);
        $role->permission_role()->detach();
        $role->delete();
    }
}