<?php

namespace App\Services;

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

    public function getPaginateCategory ($paginate = 10) {
        return  Category::with('getChildrenCateogory')
        ->with('cate_product')
        ->where('deleted_at', null)->paginate($paginate);
    }

    public function deleteCategory ($id){
        $cate = Category::findOrFail($id);
        // $cate->cate_product()->detach();
        $datetime = new DateTime();
        $cate->deleted_at = $datetime->format('Y-m-d H:i:s');
        $cate->update();

        foreach($cate->getChildrenCateogory as $item) {
            $subCate = Category::findOrFail($item->id);
            $subCate->parent_id = 0;
            $subCate->update();
        }
    }

    public function searchCategory ($textSearch) {
        $key = trim($textSearch);
        $requestData = ['cate_name'];
        $listCate;
        if($key != ''){
            $listCate = Category::where(querySearchByColumns($requestData, $key))
            ->paginate(10);
        }else{
            $listCate = $this->getPaginateCategory();
        }
        return $listCate;
    }

}
