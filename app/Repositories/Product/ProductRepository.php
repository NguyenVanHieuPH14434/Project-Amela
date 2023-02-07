<?php

namespace App\Repositories\Product;

use App\Constant\Constanst;
use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\ProductGallery\ProductGalleryRepositoryInterface;
use DateTime;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface {

    // protected $productGalleryRepo;

    // public function __construct(ProductGalleryRepositoryInterface $productGalleryRepo)
    // {
    //     $this->productGalleryRepo = $productGalleryRepo;
    // }
    public function getModel()
    {
        return Product::class;
    }

    public function getAllProduct()
    {
        return $this->model->where('is_active', Constanst::ACTIVE)
        ->where('deleted_at', null)
        ->get();
    }


    public function getProduct($req = null, $paginate = Constanst::LIMIT_PERPAG)
    {
        $data = $this->model->with(['categoryProduct', 'productGallery', 'attributeProduct'])
        ->where('is_active', Constanst::ACTIVE)
        ->where('deleted_at', null);

        $colums = ['product_name'];

        if($req != null && $req->keyword){
            $data->where(querySearchByColumns($colums, $req->keyword));
        }
        $sortOrder = sortOrder($req != null && $req->sortOrder??$req->sortOrder);

        $result = $data->orderBY('id',$sortOrder)->paginate($paginate);
        return $result;
    }

    public function insertProduct($req)
    {
        $prices = explode(',', $req->product_price);
        $stock = explode(',', $req->stock);
        $dataImage = checkIssetImage($req, [
            'image'=>'product_image',
            'prefixName'=>'product',
            'folder'=>'uploads/products',
            'imageOld'=>''
        ]);
        $product = new $this->model();
        $product->fill($req->all());
        $product->is_active = Constanst::ACTIVE;
        $product->product_image = $dataImage;
        $product->save();

        foreach($prices as $key => $val){
            $product->attributeProduct()->attach($req->attr[$key], array('price'=>$val, 'stock'=>$stock[$key]));
        }

        $product->categoryProduct()->attach($req->category_id);

        // if($req->image){
        //     $this->productGalleryRepo->insertProductGallery($product->id, $req);
        // }
        if($req->image){
            $productGallery = new ProductGalleryRepositoryInterface();

            $productGallery->insertProductGallery($product->id, $req);
        }
    }

    public function updateProduct($req, $id)
    {
        $prices = explode(',', $req->product_price);
        $stock = explode(',', $req->stock);

        $product = $this->model->findOrFail($id);
        $dataImage = checkIssetImage($req, [
            'image'=>'product_image',
            'prefixName'=>'product',
            'folder'=>'uploads/products',
            'imageOld'=>$product->product_image
        ]);
        $product->fill($req->all());
        $product->is_active = Constanst::ACTIVE;
        $product->product_image = $dataImage;
        $product->update();

        $product->categoryProduct()->sync($req->category_id);
        $product->attributeProduct()->detach();
        foreach($prices as $key => $val){
            $product->attributeProduct()->attach($req->attr[$key], array('price'=>$val, 'stock'=>$stock[$key]));
        }

        // if($req->image){
        //     $product->productGallery()->delete();
        //     $this->serviceProGallery->insertProductGallery($product->id, $req);
        // }

        if($req->image){
            $productGallery = new ProductGalleryRepositoryInterface();
            $product->productGallery()->delete();
            $productGallery->insertProductGallery($product->id, $req);
        }
    }

    public function deleteProduct($id)
    {
        $product = $this->model->findOrFail($id);
        $datetime = new DateTime();
        $product->deleted_at = $datetime->format('Y-m-d H:i:s');
        $product->update();
    }

    public function searchProduct($textSearch)
    {
        $key = trim($textSearch);
        $requestData = ['product_name'];
        $data = $this->model->where('deleted_at', null)
        ->where('is_active', Constanst::ACTIVE);

        if($key != ''){
            $data->where(querySearchByColumns($requestData, $key));
        }

        $result = $data->paginate(Constanst::LIMIT_PERPAG);
        return $result;
    }
}