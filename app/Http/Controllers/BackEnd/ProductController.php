<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Attribute;
use App\Models\Product;
use App\Services\AttributeService;
use App\Services\CategoryService;
use App\Services\ProductService;
use DateTime;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $serviceCategory;
    public $serviceProduct;
    public $serviceAttr;
    public $message = [];
    public function __construct(CategoryService $serviceCategory, ProductService $serviceProduct, AttributeService $serviceAttr)
    {
        $this->serviceCategory = $serviceCategory;
        $this->serviceProduct = $serviceProduct;
        $this->serviceAttr = $serviceAttr;
    }

    public function index()
    {
        $listProduct = $this->serviceProduct->getPaginateProduct();
        return view('pages.product.list', compact('listProduct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =  $this->serviceCategory->getAllCategory();
        $attrs =  $this->serviceAttr->getAllAttribute();
        return view('pages.product.create', compact('categories', 'attrs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        // dd($is);
        // dd($request->all());
        try {
            $this->serviceProduct->insertProduct($request);
            $this->message = ['success' => 'Thêm sản phẩm thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('categoryProduct')->with('productGallery')->findOrFail($id);
        $categories =  $this->serviceCategory->getAllCategory();
        $attrs =  $this->serviceAttr->getAllAttribute();
        $price = array();
        $stock = array();
        foreach($product->attributeProduct as $i){
            array_push($price, $i->pivot->price);
            array_push($stock, $i->pivot->stock);
        }
        return view('pages.product.edit', compact('product', 'categories', 'attrs', 'price', 'stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            $this->serviceProduct->updateProduct($request, $id);
            $this->message = ['success' => 'Cập nhật sản phẩm thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }


    public function search (Request $request) {
        $listProduct = $this->serviceProduct->searchProduct($_GET['key']);
        return view('pages.product.list', compact('listProduct'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->serviceProduct->deleteProduct($id);
            $this->message = ['success' => 'Xóa sản phẩm thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: '.$err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }
}
