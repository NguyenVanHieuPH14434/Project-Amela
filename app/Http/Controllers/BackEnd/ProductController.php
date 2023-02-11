<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Attribute;
use App\Models\Product;
use App\Repositories\Attribute\AttributeRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\AttributeService;
use App\Services\CategoryService;
use App\Services\ProductService;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $productRepo;
    public $cateRepo;
    public $attrRepo;
    public $message = [];
    public function __construct(CategoryRepositoryInterface $cateRepo, AttributeRepositoryInterface $attrRepo, ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
        $this->cateRepo = $cateRepo;
        $this->attrRepo = $attrRepo;
    }

    public function index()
    {
        $listProduct = $this->productRepo->getProduct();
        return view('pages.product.list', compact('listProduct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =  $this->cateRepo->all();
        $attrs =  $this->attrRepo->getAllAttribute();
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
        DB::beginTransaction();
        try {
            $this->productRepo->insertProduct($request);
            $this->message = ['success' => 'Thêm sản phẩm thành công!'];
            DB::commit();
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
            DB::rollBack();
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
        $categories =  $this->cateRepo->all();
      
        return view('pages.product.edit', compact('product', 'categories'));
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
        DB::beginTransaction();
        try {
            $this->productRepo->updateProduct($request, $id);
            $this->message = ['success' => 'Cập nhật sản phẩm thành công!'];
            DB::commit();
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
            DB::rollBack();
        }
        return redirect()->back()->with($this->message);
    }


    public function search (Request $request) {
        if($_GET['key'] && $_GET['key'] != null){
            $listProduct = $this->productRepo->search($_GET['key'], ['product_name']);
         return view('pages.product.list', compact('listProduct'));
        }
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->productRepo->softDelete($id);
            $this->message = ['success' => 'Xóa sản phẩm thành công!'];
            DB::commit();
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: '.$err->getMessage()];
            DB::rollBack();
        }
        return redirect()->back()->with($this->message);
    }


    public function editAttr($id)
    {
        $categories =  $this->cateRepo->all();
        $attrs =  $this->attrRepo->getAllAttribute();
        $product = Product::with(['attributeProduct', 'sizeProduct'])->findOrFail($id);
        return view('pages.product.editAttr', compact('categories', 'attrs', 'product'));
    }

    public function updateAttr(Request $req, $id)
    {
        try {
            $this->productRepo->updateAttrProduct($req, $id);
            $this->message = ['success' => 'Cập nhật biến thể sản phẩm thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }


    public function createAttr($id)
    {
        $categories =  $this->cateRepo->all();
        $attrs =  $this->attrRepo->getAllAttribute();
        $product = Product::with(['attributeProduct', 'sizeProduct'])->findOrFail($id);
        return view('pages.product.createAttr', compact('categories', 'attrs', 'product'));
    }

    public function storeAttr(Request $req, $id)
    {
        try {
            $this->productRepo->insertAttrProduct($req, $id);
            $this->message = ['success' => 'Cập nhật biến thể sản phẩm thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }

}
