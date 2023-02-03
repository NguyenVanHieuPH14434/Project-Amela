<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $serviceProduct;

    public function __construct(ProductService $serviceProduct)
    {
        $this->serviceProduct = $serviceProduct;
    }

    public function index()
    {
        $listProduct = $this->serviceProduct->getPaginateProduct();
        return response()->json([
            "success"=>true,
            "message"=>"Danh sách danh mục sản phẩm!",
            "data"=>$listProduct
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('categoryProduct')
        ->with('productGallery')
        ->with('attributeProduct')
        ->findOrFail($id);

        $similar_product = Category::with('cate_product')
        ->findOrFail($product->categoryProduct[0]->id);

        return response()->json([
            'success'=>true,
            'message'=> 'Dữ liệu sản phẩm '. $product->product_name,
            'data'=> $product,
            'similar_product'=> $similar_product->cate_product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        // $data = array();
        // foreach ($request->stock as $plan) {
        // // $data_plan = array($plan => array('stock' => $request->dia[$plan] ) );
        //     array_push($data, $plan);
        // }
        // $data = $product->attributeProduct->contains('id', $request->idAttr)?true:false;
        // DB::table('products_attributes')->where('id', $request->idAttr)->update(['stock'=>$request->stock]);

        return response()->json([
            'data'=> $request->product[0][]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
