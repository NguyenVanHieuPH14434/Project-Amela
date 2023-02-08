<?php

namespace App\Repositories\OrderItem;

use App\Constant\Constanst;
use App\Repositories\RepositoryInterface;

interface OrderItemRepositoryInterface extends RepositoryInterface {

    public function getOrderDetail ($id) ;

    public function insertOrderItem ($req, $order_id);
}