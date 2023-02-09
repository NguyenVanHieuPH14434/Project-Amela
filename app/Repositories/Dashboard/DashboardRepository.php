<?php

namespace App\Repositories\Dashboard;

use App\Models\Order;
use App\Repositories\BaseRepository;

class DashboardRepository extends BaseRepository implements DashboardRepositoryInterface {


    public function getModel()
    {
        return Order::class;
    }


    public function getDataChart()
    {
        $countCate = getCountTable('categories', ['2023-02-03', '2023-02-08'], ['deleted_at'], [null]);
        $countProduct = getCountTable('products', ['2023-02-03', '2023-02-08'], ['deleted_at'], [null]);
        return response()->json([
            'category'=>$countCate,
            'product'=>$countProduct,
        ]);
    }
}