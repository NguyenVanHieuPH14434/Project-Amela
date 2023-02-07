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

    public function getNews($req = null, $paginate = Constanst::LIMIT_PERPAG)
    {
        $data = $this->model->with(['getCateNew'])
        ->where('deleted_at', null);
        $colums = ['new_title'];

        if($req != null && $req->keyword){
            $data->where(querySearchByColumns($colums, $req->keyword));
        }
        $sortOrder = sortOrder($req != null && $req->sortOrder??$req->sortOrder);

        $result = $data->orderBY('id',$sortOrder)->paginate($paginate);
        return $result;
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

    public function deleteNews($id)
    {
        $new = $this->model->findOrFail($id);
        $datetime = new DateTime();
        $new->deleted_at = $datetime->format('Y-m-d H:i:s');
        $new->update();
    }

}