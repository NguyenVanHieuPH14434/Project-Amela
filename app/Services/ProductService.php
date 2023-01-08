<?php

namespace App\Services;

use App\Models\Attribute;
use App\Models\Permission;
use App\Models\Product;
use App\Models\ProductGallery;

class ProductService {

    public $serviceProGallery;
    public function __construct(ProductGalleryService $serviceProGallery)
    {
        $this->serviceProGallery = $serviceProGallery;
    }
    public function getAllProduct () {
        return Product::with('categoryProduct')->with('productGallery')->where('is_active', 1)->where('deleted_at', null)->get();
    }

    public function getPaginateProduct ($paginate = 10) {
        return  Product::with('categoryProduct')
        ->with('productGallery')
        ->where('is_active', 1)
        ->where('deleted_at', null)
        ->paginate($paginate);
    }

    public function insertProduct ($req) {
        $prices = explode(',', $req->product_price);
        $stock = explode(',', $req->stock);
        $dataImage = checkIssetImage($req, [
            'image'=>'product_image',
            'prefixName'=>'product',
            'folder'=>'uploads/products',
            'imageOld'=>''
        ]);
        $product = new Product();
        $product->fill($req->all());
        $product->is_active = 1;
        $product->product_image = $dataImage;
        $product->save();

        foreach($prices as $key => $val){
            $product->attributeProduct()->attach($req->attr[$key], array('price'=>$val, 'stock'=>$stock[$key]));
        }

        $product->categoryProduct()->attach($req->category_id);

        if($req->image){
            $this->serviceProGallery->insertProductGallery($product->id, $req);
        }

    }

    public function updateProduct ($req, $id) {
        $prices = explode(',', $req->product_price);
        $stock = explode(',', $req->stock);

        $product = Product::findOrFail($id);
        $dataImage = checkIssetImage($req, [
            'image'=>'product_image',
            'prefixName'=>'product',
            'folder'=>'uploads/products',
            'imageOld'=>$product->product_image
        ]);
        $product->fill($req->all());
        $product->is_active = 1;
        $product->product_image = $dataImage;
        $product->update();

        $product->categoryProduct()->sync($req->category_id);
        $product->attributeProduct()->detach();
        foreach($prices as $key => $val){
            $product->attributeProduct()->attach($req->attr[$key], array('price'=>$val, 'stock'=>$stock[$key]));
        }

        if($req->image){
            $product->productGallery()->delete();
            $this->serviceProGallery->insertProductGallery($product->id, $req);
        }
    }
}
