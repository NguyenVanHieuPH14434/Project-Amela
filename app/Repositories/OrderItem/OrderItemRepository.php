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
        $data = $this->model->with(['getProduct', 'getAttrColor', 'getAttrSize'])->where('order_id', $id)->where('deleted_at',null)->get();
        $orderData = Order::with('getStatuss')->where('id', $id)->where('deleted_at',null)->first();
        $result = [
            'customer'=> $orderData,
            'data'=> $data,
        ];
        return $result;
    }

    public function insertOrderItem ($req, $order_id) {
           
        foreach($req->data as $item){
            $orderItem = new $this->model();
            $orderItem->order_id = $order_id;
            $orderItem->size_id = $item['size_id'];
            $orderItem->color_id = $item['color_id'];
            $orderItem->product_id = $item['product_id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->save();

            $columns = ['size_id', 'color_id', 'product_id'];
            $value = [$item['size_id'], $item['color_id'], $item['product_id']];

            $updateStock = DB::table('products_attributes')
            ->where(queryByColumns($columns, $value))
            ->first();
            $newStock = (int)$updateStock->stock - (int)$item['quantity'];
            DB::table('products_attributes')
            ->where(queryByColumns($columns, $value))
            ->update(['stock'=>$newStock]);
        }

    }

}