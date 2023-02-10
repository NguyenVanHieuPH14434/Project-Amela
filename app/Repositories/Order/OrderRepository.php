<?php

namespace App\Repositories\Order;

use App\Constant\Constanst;
use App\Models\Order;
use App\Repositories\BaseRepository;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use App\Services\OrderItemService;
use Illuminate\Support\Facades\Auth;
use Mockery\Matcher\Contains;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface {

    protected $orderItemRepo;

    public function getModel()
    {
        return Order::class;
    }

    public function __construct(OrderItemRepositoryInterface $orderItemRepo)
    {
        parent::__construct($orderItemRepo);
        $this->orderItemRepo = $orderItemRepo;
    }

    public function getAllOrder ($user_id) {
        return $this->model->with('getOrderItem')->where('user_id', $user_id)->where('deleted_at',null)->get();
    }

    public function getOrder ($paginate = Constanst::LIMIT_PERPAG) {
        $columns = ['id', 'code_order', 'created_at'];
        $data = $this->model->with('getStatuss')->where('deleted_at', null)->where(function($q) use($columns) {
            scopeFilter($q, $columns);
        });
        
        $result = $data->orderBY(sortBy($columns), sortOrder())->paginate($paginate);
        return $result;
    }

    public function getPaginateOrder ($user_id, $paginate = Constanst::LIMIT_PERPAG) {

        $columns = ['id', 'code_order', 'created_at'];
        $data = $this->model->with('getStatuss')->where('user_id', $user_id)
        ->where('deleted_at', null)->where(function($q) use($columns) {
            scopeFilter($q, $columns);
        });
        
        $result = $data->orderBY(sortBy($columns), sortOrder())->paginate(request('per_page')?request('per_page'):$paginate);
        return $result;
    }

    public function insertOrder ($req) {
            $order = new $this->model();
            $order->customer = $req->customer['customer'];
            $order->address = $req->customer['address'];
            $order->email = $req->customer['email'];
            $order->phone = $req->customer['phone'];
            $order->note = $req->customer['note'];
            $order->user_id = Auth::guard('api')->id();
            $order->payment_id = $req->customer['payment_id'];
            $order->total_price = $req->customer['total_price'];
            $order->code_order = generateUniqueCode();
            $order->status_order = Constanst::UNCONFIMRER;
            $order->save();

            $this->orderItemRepo->insertOrderItem($req, $order->id);

    }

}