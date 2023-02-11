<?php

namespace App\Repositories\Attribute;

use App\Constant\Constanst;
use App\Models\Attribute;
use App\Repositories\BaseRepository;

class AttributeRepository extends BaseRepository implements AttributeRepositoryInterface {

    public function getModel()
    {
        return Attribute::class;
    }

    public function getAllAttribute()
    {
        return $this->model->get();
    }

    public function getAttribute($paginate = Constanst::LIMIT_PERPAG)
    {
        $columns = ['attr_name', 'id', 'created_at'];
        $data = $this->model->where(function($q) use($columns){
            scopeFilter($q, $columns);
        });

        $result = $data->orderBY(sortBy($columns), sortOrder())->paginate($paginate);
        return $result;
    }

    public function insertAttribute($req)
    {
        foreach($req->attr_name as $key => $attr_name){
            $attribute = new $this->model();
            $attribute->attr_name = $attr_name;
            $attribute->attr_key = $req->attr_key;
            $attribute->attr_value = $req->attr_key == 'size'?null:$req->attr_value[$key];
            $attribute->save();
        }
    }

    public function updateAttribute($req, $id)
    {
        $attr = $this->model->findOrFail($id);
        $attr->fill($req->all());
        $attr->update();
    }

    public function deleteAttribute($id)
    {
        $this->model->findOrFail($id)->delete();
    }


    public function searchAttribute($key, $columns = [])
    {
        
        if($key != ''){
            $data = $this->model->where(querySearchByColumns($columns, trim($key)));
        }

        $result = $data->paginate(Constanst::LIMIT_PERPAG);
        return $result;
    }
}