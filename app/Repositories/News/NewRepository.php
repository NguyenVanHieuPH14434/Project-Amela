<?php

namespace App\Repositories\News;

use App\Constant\Constanst;
use App\Models\News;
use App\Repositories\BaseRepository;
use DateTime;

class NewRepository extends BaseRepository implements NewRepositoryInterface {

    public function getModel()
    {
        return News::class;
    }

    public function getAllNews()
    {
        return $this->model->where('deleted_at', null)->get();
    }

    public function getNews($paginate = Constanst::LIMIT_PERPAG)
    {
        $columns = ['new_title', 'created_at', 'id'];
        $data = $this->model->with(['getCateNew'])
        ->where('deleted_at', null)->where(function($q) use($columns) {
            scopeFilter($q, $columns);
        });

        $result = $data->orderBY(sortBy($columns), sortOrder())->paginate(request('per_page')?request('per_page'):$paginate);
        return $result;
    }

    public function getNewDetail ($id) {
        return $this->model::with('getCateNew')->where('id', $id)->where('deleted_at', null)->first();
    }

    public function insertNews($req)
    {
        $new = new $this->model();
        $new->fill($req->all());
        $new->save();
        $new->getCateNew()->attach($req->cateNew);
    }

    public function updateNews($req, $id)
    {
        $new = $this->model->findOrFail($id);
        $new->fill($req->all());
        $new->update();
        $new->getCateNew()->sync($req->cateNew);
    }

}