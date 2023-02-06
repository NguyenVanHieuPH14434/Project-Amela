<?php

namespace App\Services;

use App\Constant\Constanst;
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

    public function getPaginateNew ($paginate = Constanst::LIMIT_PERPAG) {
        return  News::with('getCateNew')->where('deleted_at', null)->paginate($paginate);
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
            ->paginate(Constanst::LIMIT_PERPAG);
        }else{
            $listNew = $this->getPaginateNew();
        }
        return $listNew;
    }

}
