<?php

namespace App\Services;

use App\Constant\Constanst;
use App\Models\Attribute;
use App\Models\Order;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

use function GuzzleHttp\Promise\all;

class OrderService {

    protected $orderItemService;
    public function __construct(OrderItemService $orderItemService)
    {
        $this->orderItemService = $orderItemService;
    }
    public function getAllOrder ($user_id) {
        return Order::with('getOrderItem')->where('user_id', $user_id)->where('deleted_at',null)->get();
    }

    public function getPaginateOrder ($user_id, $paginate = Constanst::LIMIT_PERPAG) {
        return Order::with('getOrderItem')->where('user_id', $user_id)->where('deleted_at',null)->paginate($paginate);
    }

    public function insertOrder ($req) {
            $order = new Order();
            $order->customer = $req->customer['customer'];
            $order->address = $req->customer['address'];
            $order->email = $req->customer['email'];
            $order->phone = $req->customer['phone'];
            $order->note = $req->customer['note'];
            $order->user_id = $req->customer['user_id'];
            $order->payment_id = $req->customer['payment_id'];
            $order->total_price = $req->customer['total_price'];
            $order->code_order = generateUniqueCode();
            $order->status_order = 1;
            $order->save();

            $this->orderItemService->insertOrderItem($req, $order->id);

    }

}
