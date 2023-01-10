<?php

namespace App\Services;

use App\Models\Attribute;
use App\Models\Permission;
use Mockery\Undefined;

class AttributeService {

    public function getAllAttribute () {
        return Attribute::with('getSubAttribute')->where('parent_id', 0)->get();
    }

    public function getPaginateAttribute ($paginate = 10) {
        return  Attribute::with('getSubAttribute')->where('parent_id', 0)->paginate($paginate);
    }

    public function insertAttribute ($req) {
            $attribute = new Attribute();
            $attribute->attr_name = $req->parent_attr_name;
            $attribute->save();

            $this->insertSubAttribute(array('name'=>$req->attr_name, 'img'=>$req->attr_img, 'desc'=>$req->attr_desc), $attribute->id);

    }


    public function insertSubAttribute ($data = array('name'=>array(), 'img'=>array(), 'desc'=>array()), $parentId) {
        foreach($data['name'] as $key => $val){
            $subAttribute = new Attribute();
            $subAttribute->attr_name = $val;
            $subAttribute->attr_img = isset($data['img'][$key])
            ?fileUpload($data['img'][$key], 'attribute', 'uploads/attributes')
            :null;
            $subAttribute->attr_desc = $data['desc'][$key];
            $subAttribute->parent_id = $parentId;
            $subAttribute->save();
        }
    }

    public function updateAttribute ($req, $id){
        $attr = Attribute::findOrFail($id);
        $attr->fill($req->all());
        $attr->attr_name = $req->parent_attr_name;
        $attr->update();

        foreach($req->subId as $key => $val){
            $attr = Attribute::findOrFail($val);
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

    public function deleteAttribute ($id) {
        $attr = Attribute::findOrFail($id);
        $attr->getSubAttribute()->delete();
        $attr->delete();
    }

    public function searchAttribute ($textSearch) {
        $key = trim($textSearch);
        $requestData = ['attr_name'];
        $listAttr;
        if($key != ''){
            $listAttr = Attribute::where('parent_id', 0)->where(querySearchByColumns($requestData, $key))
            ->paginate(10);
        }else{
            $listAttr = $this->getPaginateAttribute();
        }
        return $listAttr;
    }


}
