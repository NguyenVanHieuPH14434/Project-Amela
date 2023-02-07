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

    public function getNewCategory($req = null, $paginate = Constanst::LIMIT_PERPAG)
    {
        $data = $this->model->with(['getNew'])
        ->where('deleted_at', null);
        $columns = ['new_cate_name'];

        if($req != null && $req->keyword){
            $data->where(querySearchByColumns($columns, $req->keyword));
        }

        $sortOrder = sortOrder($req != null && $req->sortOrder??$req->sortOrder);

        $result = $data->orderBY('id',$sortOrder)->paginate($paginate);
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

    public function deleteNewCategory($id)
    {
        $cateNew = $this->model->findOrFail($id);
        $datetime = new DateTime();
        $cateNew->deleted_at = $datetime->format('Y-m-d H:i:s');
        $cateNew->update();
    }

}