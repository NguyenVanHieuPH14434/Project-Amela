<?php

namespace App\Repositories\Product;

use App\Constant\Constanst;
use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\ProductGallery\ProductGalleryRepositoryInterface;
use DateTime;
use Illuminate\Support\Facades\Storage;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface {

    protected $productGallery;

    public function getModel()
    {
        return Product::class;
    }

    public function __construct(ProductGalleryRepositoryInterface $productGallery)
    {
        parent::__construct($productGallery);
        $this->productGallery = $productGallery;
    }

    public function getAllProduct()
    {
        return $this->model->where('is_active', Constanst::ACTIVE)
        ->where('deleted_at', null)
        ->get();
    }


    public function getProduct($paginate = Constanst::LIMIT_PERPAG)
    {
        $columns = ['product_name', 'id', 'created_at'];
        $data = $this->model->with(['categoryProduct', 'productGallery', 'attributeProduct'])
        ->where('is_active', Constanst::ACTIVE)
        ->where('deleted_at', null);

        $data->where(function($q) use($columns){
            scopeFilter($q, $columns);
        });

        $result = $data->orderBY(sortBy($columns), sortOrder())->paginate($paginate);
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
        $product->product_price = min($prices)."-".max($prices);
        $product->save();

        foreach($prices as $key => $val){
            $product->attributeProduct()->attach($req->attr[$key], array('price'=>$val, 'stock'=>$stock[$key]));
        }

        $product->categoryProduct()->attach($req->category_id);

        if($req->image){
            $this->productGallery->insertProductGallery($product->id, $req);
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
        $product->product_price = min($prices)."-".max($prices);
        $product->update();

        $product->categoryProduct()->sync($req->category_id);
        $product->attributeProduct()->detach();
        foreach($prices as $key => $val){
            $product->attributeProduct()->attach($req->attr[$key], array('price'=>$val, 'stock'=>$stock[$key]));
        }

        if($req->image){
            foreach( $product->productGallery as $it){
                deleteFile($it->path_image);
            }
            $product->productGallery()->delete();
            $this->productGallery->insertProductGallery($product->id, $req);
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