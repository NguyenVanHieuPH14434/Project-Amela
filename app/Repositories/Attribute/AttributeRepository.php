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
        return $this->model->with(['getSubAttribute'])
        ->where('parent_id', Constanst::PARENT)->get();
    }

    public function getAttribute($paginate = Constanst::LIMIT_PERPAG)
    {
        $columns = ['attr_name', 'id', 'created_at'];
        $data = $this->model->with(['getSubAttribute'])
        ->where('parent_id', Constanst::PARENT)->where(function($q) use($columns){
            scopeFilter($q, $columns);
        });

        $result = $data->orderBY(sortBy($columns), sortOrder())->paginate($paginate);
        return $result;
    }

    public function insertAttribute($req)
    {
        $attribute = new $this->model();
        $attribute->attr_name = $req->parent_attr_name;
        $attribute->save();

        $this->insertSubAttribute(array('name'=>$req->attr_name, 'img'=>$req->attr_img, 'desc'=>$req->attr_desc), $attribute->id);
    }

    
    public function insertSubAttribute ($data = array('name'=>array(), 'img'=>array(), 'desc'=>array()), $parentId) {
        foreach($data['name'] as $key => $val){
            $subAttribute = new $this->model();
            $subAttribute->attr_name = $val;
            $subAttribute->attr_img = isset($data['img'][$key])
            ?fileUpload($data['img'][$key], 'attribute', 'uploads/attributes')
            :null;
            $subAttribute->attr_desc = $data['desc'][$key];
            $subAttribute->parent_id = $parentId;
            $subAttribute->save();
        }
    }

    public function updateAttribute($req, $id)
    {
        $attr = $this->model->findOrFail($id);
        $attr->fill($req->all());
        $attr->attr_name = $req->parent_attr_name;
        $attr->update();

        foreach($req->subId as $key => $val){
            $attr = $this->model->findOrFail($val);
            $attr->fill($req->all());
            $attr->attr_name = $req->sub_name[$key];
            $attr->attr_img = isset($req->sub_img[$key])
            ?fileUpload($req->sub_img[$key], 'attribute', 'uploads/attributes')
            :$attr->attr_img;
            $attr->attr_desc = $req->sub_desc[$key];
            $attr->update();
        }

        if($req->attr_name && $req->attr_name != null){
            $this->insertSubAttribute(array('name'=>$req->attr_name, 'img'=>$req->attr_img, 'desc'=>$req->attr_desc), $id);
        }
    }

    public function deleteAttribute($id)
    {
        $attr = $this->model->findOrFail($id);
        $attr->getSubAttribute()->delete();
        $attr->delete();
    }


    public function searchAttribute($key, $columns = [])
    {
        $data = $this->model->where('parent_id', Constanst::PARENT);

        if($key != ''){
            $data->where(querySearchByColumns($columns, trim($key)));
        }

        $result = $data->paginate(Constanst::LIMIT_PERPAG);
        return $result;
    }
}