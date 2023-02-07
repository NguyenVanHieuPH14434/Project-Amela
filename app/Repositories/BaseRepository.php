<?php

namespace App\Repositories;

use App\Constant\Constanst;

abstract class BaseRepository implements RepositoryInterface {

    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();
    
    public function setModel(){
        $this->model = app()->make($this->getModel());
    }

    public function all () {
        return $this->model->all();
    }

    public function find ($id) {
        $result = $this->model->findOrFail($id);
        return $result;
    }

    public function create($data = [])
    {
        return $this->model->create($data);
    }

    public function update($data = [], $id) { 
        $result = $this->find($id);
        if($result){
            $result->update($data);
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if($result){
            $result->delete();
            return true;
        }

        return false;
    }

    public function search($key, $columns = [])
    {
        $data = $this->model->where('deleted_at', null);

        if($key != ''){
            $data->where(querySearchByColumns($columns, trim($key)));
        }

        $result = $data->paginate(Constanst::LIMIT_PERPAG);
        return $result;
    }

}