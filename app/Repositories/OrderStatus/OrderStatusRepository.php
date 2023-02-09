<?php

namespace App\Repositories\OrderStatus;

use App\Constant\Constanst;
use App\Models\OrderStatus;
use App\Repositories\BaseRepository;

class OrderStatusRepository extends BaseRepository implements OrderStatusRepositoryInterface{
    public function getModel()
    {
        return OrderStatus::class;
    }

    public function getAllOrderStatus()
    {
        return $this->model->where('deleted_at', null)->get();
    }

    public function getOrderStatus($paginate = Constanst::LIMIT_PERPAG)
    {
        $columns = ['id', 'status_name', 'created_at'];
        $data = $this->model->where('deleted_at', null)->where(function($q) use($columns) {
            scopeFilter($q, $columns);
        });
        
        $result = $data->orderBY(sortBy($columns), sortOrder())->paginate($paginate);
        return $result;
    }

    public function insertOrderStatus($req)
    {
        $orderStatus = new $this->model();
        $orderStatus->fill($req->all());
        $orderStatus->save();
    }

    public function updateOrderStatus($req, $id)
    {
        $orderStatus = $this->model->find($id);
        $orderStatus->fill($req->all());
        $orderStatus->update();
    }

}