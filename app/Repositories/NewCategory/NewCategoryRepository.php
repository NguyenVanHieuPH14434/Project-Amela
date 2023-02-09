<?php

namespace App\Repositories\NewCategory;

use App\Constant\Constanst;
use App\Models\CategoryNew;
use App\Repositories\BaseRepository;
use DateTime;

class NewCategoryRepository extends BaseRepository implements NewCategoryRepositoryinterface {

    public function getModel()
    {
        return CategoryNew::class;
    }

    public function getAllNewCategory()
    {
        return $this->model->where('deleted_at', null)->get();
    }

    public function getNewCategory($paginate = Constanst::LIMIT_PERPAG)
    {
        $columns = ['new_cate_name', 'created_at', 'id'];
        $data = $this->model->with(['getNew'])
        ->where('deleted_at', null)->where(function($q) use($columns) {
            scopeFilter($q, $columns);
        });

        $result = $data->orderBY(sortBy($columns), sortOrder())->paginate(request('per_page')?request('per_page'):$paginate);
        return $result;
    }

    public function insertNewCategory($req)
    {
        $dataImage = checkIssetImage($req, [
            'image'=>'new_cate_image',
            'prefixName'=>'categoryNew',
            'folder'=>'uploads/categorynews',
            'imageOld'=>''
        ]);
        $cateNew = new $this->model();
        $cateNew->fill($req->all());
        $cateNew->new_cate_image = $dataImage;
        $cateNew->save();
    }

    public function updateNewCategory($req, $id)
    {
        $cateNew = $this->model->findOrFail($id);
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

    

}