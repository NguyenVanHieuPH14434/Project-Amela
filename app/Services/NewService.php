<?php

namespace App\Services;

use App\Models\Category;
use App\Models\CategoryNew;
use App\Models\News;
use App\Models\Permission;
use App\Models\Role;
use DateTime;

class NewService {

    public function getAllNew () {
        return News::where('deleted_at', null)->get();
    }

    public function getPaginateNew ($paginate = 10) {
        return  News::where('deleted_at', null)->paginate($paginate);
    }

    public function insertNew ($req) {
        $new = new News();
        $new->fill($req->all());
        $new->save();
        $new->getCateNew()->attach($req->cateNew);
    }

    public function updateNew ($req, $id){
        $new = News::findOrFail($id);
        $new->fill($req->all());
        $new->update();
        $new->getCateNew()->sync($req->cateNew);
    }

    public function deleteNew ($id){
        $new = News::findOrFail($id);
        $datetime = new DateTime();
        $new->deleted_at = $datetime->format('Y-m-d H:i:s');
        $new->update();
    }

    public function searchNew ($textSearch) {
        $key = trim($textSearch);
        $requestData = ['id', 'new_title'];
        $listNew;
        if($key != ''){
            $listNew = News::where('deleted_at', null)->where(querySearchByColumns($requestData, $key))
            ->paginate(10);
        }else{
            $listNew = $this->getPaginateNew();
        }
        return $listNew;
    }

}
