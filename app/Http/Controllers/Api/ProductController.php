<?php

namespace App\Http\Controllers\Api;

use App\Constant\Constanst;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\ProductService;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $productRepo;

    public function __construct( ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function index()
    {
        $listProduct = $this->productRepo->getProduct();
        return response()->json([
            "success"=>true,
            "message"=>"Danh sách danh mục sản phẩm!",
            "data"=>$listProduct
        ], Response::HTTP_OK);
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
        ->findOrFail($id);
        
        $colors = array();
        $size = array();

        foreach($product->attributeProduct as $key => $it){
            array_push($colors, $it->pivot->color_id);
            array_push($size, $product->sizeProduct[$key]->pivot->size_id);
        }

        $colorsData = getDataWhereIn('attributes', 'id', $colors);
        $sizeData = getDataWhereIn('attributes', 'id', $size);

        $similar_product = Category::with(['cate_product'=>function($q){
            $q->take(Constanst::LIMIT_SIMILAR_PRODUCT);
        }])
        ->findOrFail($product->categoryProduct[0]->id);

        return response()->json([
            'success'=>true,
            'message'=> 'Dữ liệu sản phẩm '. $product->product_name,
            'data'=> $product,
            'colors'=> $colorsData,
            'size'=> $sizeData,
            'similar_product'=> $similar_product->cate_product,
        ], Response::HTTP_OK);
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
