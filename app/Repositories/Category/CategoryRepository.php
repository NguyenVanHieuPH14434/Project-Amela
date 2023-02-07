<?php

namespace App\Repositories\Category;

use App\Constant\Constanst;
use App\Models\Category;
use App\Repositories\BaseRepository;
use DateTime;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface {

    public function getModel()
    {
        return Category::class;
    }

    public function getAllCategory()
    {
        return $this->model->where('deleted_at', null)->get();
    }

    public function getCategory($req = null, $paginate = Constanst::LIMIT_PERPAG)
    {
        $data = $this->model->with(['getChildrenCateogory', 'cate_product'])
        ->where('deleted_at', null);
        $colums = ['cate_name', 'cate_desc'];

        if($req != null && $req->keyword){
            $data->where(querySearchByColumns($colums, $req->keyword));
        }
        $sortOrder = sortOrder($req != null && $req->sortOrder??$req->sortOrder);

        $result = $data->orderBY('id',$sortOrder)->paginate($paginate);
        return $result;
    }

    public function insertCategory($req)
    {
        $dataImage = checkIssetImage($req, [
            'image'=>'cate_image',
            'prefixName'=>'category',
            'folder'=>'uploads/categories',
            'imageOld'=>''
        ]);
        $cate = new $this->model();
        $cate->fill($req->all());
        $cate->cate_image = $dataImage;
        $cate->save();

    }

    public function updateCategory($req, $id)
    {
        $cate = $this->model->find($id);
        $cate->fill($req->all());
        $dataImage = checkIssetImage($req, [
        'image'=>'cate_image',
        'prefixName'=>'category',
        'folder'=>'uploads/categories',
        'imageOld'=> $cate->cate_image,
        ]);
        $cate->cate_image = $dataImage;
        $cate->update();
    }

    public function deleteCategory($id)
    {
        $cate = $this->model->find($id);
        $datetime = new DateTime();
        $cate->deleted_at = $datetime->format('Y-m-d H:i:s');
        $cate->update();

        foreach($cate->getChildrenCateogory as $item) {
            $subCate = $this->model->find($item->id);
            $subCate->parent_id = Constanst::PARENT;
            $subCate->update();
        }
    }

}