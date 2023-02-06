<?php

namespace App\Services;

use App\Constant\Constanst;
use App\Models\Category;
use App\Models\Permission;
use App\Models\Role;
use DateTime;

class CategoryService {

    public function getAllCategory () {
        return Category::with('getChildrenCateogory')
        ->with('cate_product')
        ->where('deleted_at', null)->get();
    }

    public function getPaginateCategory ($paginate = Constanst::LIMIT_PERPAG) {
        return  Category::with('getChildrenCateogory')
        ->with('cate_product')
        ->where('deleted_at', null)->paginate($paginate);
    }

    public function deleteCategory ($id){
        $cate = Category::findOrFail($id);
        $datetime = new DateTime();
        $cate->deleted_at = $datetime->format('Y-m-d H:i:s');
        $cate->update();

        foreach($cate->getChildrenCateogory as $item) {
            $subCate = Category::findOrFail($item->id);
            $subCate->parent_id = Constanst::PARENT;
            $subCate->update();
        }
    }

    public function searchCategory ($textSearch) {
        $key = trim($textSearch);
        $requestData = ['cate_name'];
        $listCate;
        if($key != ''){
            $listCate = Category::where(querySearchByColumns($requestData, $key))
            ->paginate(Constanst::LIMIT_PERPAG);
        }else{
            $listCate = $this->getPaginateCategory();
        }
        return $listCate;
    }

}
