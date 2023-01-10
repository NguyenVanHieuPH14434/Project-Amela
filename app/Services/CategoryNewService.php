<?php

namespace App\Services;

use App\Models\Category;
use App\Models\CategoryNew;
use App\Models\Permission;
use App\Models\Role;
use DateTime;

class CategoryNewService {

    public function getAllCategoryNew () {
        return CategoryNew::where('deleted_at', null)->get();
    }

    public function getPaginateCategoryNew ($paginate = 10) {
        return  CategoryNew::where('deleted_at', null)->paginate($paginate);
    }

    public function insertCategoryNew ($req) {
        $dataImage = checkIssetImage($req, [
            'image'=>'new_cate_image',
            'prefixName'=>'categoryNew',
            'folder'=>'uploads/categorynews',
            'imageOld'=>''
        ]);
        $cateNew = new CategoryNew();
        $cateNew->fill($req->all());
        $cateNew->new_cate_image = $dataImage;
        $cateNew->save();
    }

    public function updateCategoryNew ($req, $id){
        $cateNew = CategoryNew::findOrFail($id);
        $cateNew->fill($req->all());
        $dataImage = checkIssetImage($req, [
            'image'=>'new_cate_image',
            'prefixName'=>'categoryNew',
            'folder'=>'uploads/categorynews',
            'imageOld'=>$cateNew->new_cate_image
        ]);
        $cateNew->new_cate_image = $dataImage;
        $cateNew->update();
    }

    public function deleteCategoryNew ($id){
        $cateNew = CategoryNew::findOrFail($id);
        $datetime = new DateTime();
        $cateNew->deleted_at = $datetime->format('Y-m-d H:i:s');
        $cateNew->update();
    }

    public function searchCategoryNew ($textSearch) {
        $key = trim($textSearch);
        $requestData = ['id', 'new_cate_name'];
        $listCateNew;
        if($key != ''){
            $listCateNew = CategoryNew::where('deleted_at', null)->where(querySearchByColumns($requestData, $key))
            ->paginate(10);
        }else{
            $listCateNew = $this->getPaginateCategoryNew();
        }
        return $listCateNew;
    }

}
