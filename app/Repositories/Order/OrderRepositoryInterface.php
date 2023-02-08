<?php

namespace App\Repositories\Order;

use App\Constant\Constanst;
use App\Repositories\RepositoryInterface;
use App\Services\OrderItemService;

interface OrderRepositoryInterface extends RepositoryInterface {

    public function getAllOrder ($user_id);

    public function getPaginateOrder ($user_id, $paginate = Constanst::LIMIT_PERPAG);

    public function insertOrder ($req);
}