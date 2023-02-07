<?php

namespace App\Services;

use App\Constant\Constanst;
use App\Models\Attribute;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Mockery\Undefined;

class OrderItemService {

    public function getAllOrderItem () {
        return OrderItem::with('getSubAttribute')->where('parent_id', Constanst::PARENT)->get();
    }

    public function getPaginateOrderItem ($paginate = Constanst::LIMIT_PERPAG) {
        return OrderItem::with('getSubAttribute')->where('parent_id', Constanst::PARENT)->paginate($paginate);
    }

    public function insertOrderItem ($req, $order_id) {
           
        foreach($req->data as $key => $item){
            $orderItem = new OrderItem();
            $orderItem->order_id = $order_id;
            $orderItem->attr_id = $item['attr_id'];
            $orderItem->product_id = $item['product_id'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->save();

            $updateStock = DB::table('products_attributes')->where('attr_id', $item['attr_id'])->where('product_id', $item['product_id'])->first();
                $newStock =$updateStock->stock - $item['quantity'];
            DB::table('products_attributes')->where('attr_id', $item['attr_id'])->where('product_id', $item['product_id'])->update(['stock'=>$newStock]);
        }

    }

}
