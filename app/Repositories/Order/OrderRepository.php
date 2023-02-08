<?php

namespace App\Repositories\Order;

use App\Constant\Constanst;
use App\Models\Order;
use App\Repositories\BaseRepository;
use App\Services\OrderItemService;
use Illuminate\Support\Facades\Auth;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface {

    protected $orderItemRepo;

    public function getModel()
    {
        return Order::class;
    }

    public function __construct(OrderItemService $orderItemRepo)
    {
        parent::__construct($orderItemRepo);
        $this->orderItemRepo = $orderItemRepo;
    }

    public function getAllOrder ($user_id) {
        return $this->model->with('getOrderItem')->where('user_id', $user_id)->where('deleted_at',null)->get();
    }

    public function getPaginateOrder ($user_id, $paginate = Constanst::LIMIT_PERPAG) {
        return $this->model->where('user_id', $user_id)->where('deleted_at',null)->paginate($paginate);
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
            $order->status_order = 1;
            $order->save();

            $this->orderItemRepo->insertOrderItem($req, $order->id);

    }

}