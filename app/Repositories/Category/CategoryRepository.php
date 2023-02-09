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

    public function getCategory($paginate = Constanst::LIMIT_PERPAG)
    {
        $columns = ['cate_name', 'cate_desc', 'created_at', 'id'];
        $data = $this->model->with(['getChildrenCateogory', 'cate_product'])
        ->where('deleted_at', null)->where(function($q) use($columns) {
            scopeFilter($q, $columns);
        });
        
        $result = $data->orderBY(sortBy($columns), sortOrder())->paginate($paginate);
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
        $cate = $this->softDelete($id);
        foreach($cate->getChildrenCateogory as $item) {
            $subCate = $this->model->find($item->id);
            $subCate->parent_id = Constanst::PARENT;
            $subCate->update();
        }
    }

}