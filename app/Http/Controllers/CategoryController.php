<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function cate () {
        $list = Category::where('id', 2)
        // ->with(['cate_product'=>function($query){
        //         $query->select('*');
        //     }])
            ->first(['*']);
            // dd($list->cate_product);
        // $list = Category::with(['cate_product'=>function($query){
        //     $query->select('cate_id','product_id');
        // }])->get();
        // dd($list);
        foreach($list->cate_product as $l){
            echo '<ul><li>'.$l->pivot->created_at.'</li></ul>';
        }
        die;
        // $dd = $list->cate_product->first()->pivot;
        // dd(response()->json([
        //     'list'=>$list->toArray()
        // ]));
        // dd(response()->json([
        //     'list'=>$list->toArray()
        // ]));
        // $list = Category::with('cate_product')->get();
        // dd(response()->json([
        //     'list'=>$list->toArray()
        // ]));
    }
}
