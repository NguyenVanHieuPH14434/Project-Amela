<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Permission;
use App\Models\Role;
use DateTime;

class CategoryService {

    public function getAllCategory () {
        return Category::where('deleted_at', null)->get();
    }

    public function getPaginateCategory ($paginate = 10) {
        return  Category::with('getChildrenCateogory')->where('deleted_at', null)->paginate($paginate);
    }

    public function deleteCategory ($id){
        $cate = Category::findOrFail($id);
        // $cate->cate_product()->detach();
        $datetime = new DateTime();
        $cate->deleted_at = $datetime->format('Y-m-d H:i:s');
        $cate->update();
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
