<?php 

namespace App\Repositories\OrderStatus;

use App\Constant\Constanst;
use App\Repositories\RepositoryInterface;

interface OrderStatusRepositoryInterface extends RepositoryInterface {

    public function getAllOrderStatus ();
    
    public function getOrderStatus ($paginate = Constanst::LIMIT_PERPAG);
    
    public function insertOrderStatus ($req);
    
    public function updateOrderStatus ($req, $id);

}