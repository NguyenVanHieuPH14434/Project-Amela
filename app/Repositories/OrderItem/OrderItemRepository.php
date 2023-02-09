<?php

namespace App\Repositories\OrderItem;

use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\BaseRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderItemRepository extends BaseRepository implements OrderItemRepositoryInterface {


    public function getModel()
    {
        return OrderItem::class;
    }

    public function getOrderDetail ($id) {
        $data = $this->model->with(['getProduct', 'getAttr'])->where('order_id', $id)->where('deleted_at',null)->get();
        $orderData = Order::where('id', $id)->where('deleted_at',null)->first();
        $result = [
            'customer'=> $orderData,
            'statusOrder'=> $orderData->getStatuss,
            'data'=> $data,
        ];
        return $result;
    }

    public function insertOrderItem ($req, $order_id) {
           
        foreach($req->data as $item){
            $orderItem = new $this->model();
            $orderItem->order_id = $order_id;
            $orderItem->attr_id = $item['attr_id'];
            $orderItem->product_id = $item['product_id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->save();

            $updateStock = DB::table('products_attributes')->where('attr_id', $item['attr_id'])->where('product_id', $item['product_id'])->first();
            $newStock = (int)$updateStock->stock - (int)$item['quantity'];
            DB::table('products_attributes')->where('attr_id', $item['attr_id'])->where('product_id', $item['product_id'])->update(['stock'=>$newStock]);
        }

    }

}