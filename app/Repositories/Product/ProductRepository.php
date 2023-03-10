<?php

namespace App\Repositories\Product;

use App\Constant\Constanst;
use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\ProductGallery\ProductGalleryRepositoryInterface;
use DateTime;
use Illuminate\Support\Facades\DB;
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
        $columns = ['product_name', 'id', 'created_at', 'product_price'];
        $data = $this->model->with(['categoryProduct', 'productGallery', 'attributeProduct', 'sizeProduct'])
        ->where('is_active', Constanst::ACTIVE)
        ->where('deleted_at', null);

        $data->where(function($q) use($columns){
            scopeFilter($q, $columns);
        });

        $result = $data->orderBY(sortBy($columns), sortOrder())->paginate(request('per_page')?request('per_page'):$paginate);
        return $result;
    }

    public function insertProduct($req)
    {
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
        $product->product_price = Constanst::ACTIVE;
        $product->save();

        $product->categoryProduct()->attach($req->category_id);

        if($req->image){
            $this->productGallery->insertProductGallery($product->id, $req);
        }
    }

    public function updateProduct($req, $id)
    {
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
       
        if($req->image){
            foreach( $product->productGallery as $it){
                deleteFile($it->path_image);
            }
            $product->productGallery()->delete();
            $this->productGallery->insertProductGallery($product->id, $req);
        }
    }

    public function insertAttrProduct($req, $id)
    {
        $product = $this->model->find($id);
        $prices = array_merge($req->priceOld?$req->priceOld:[Constanst::PARENT], $req->price?$req->price:[Constanst::PARENT]);
        $product->product_price = min($prices);
        $product->update();

            foreach($req->color_id as $key => $val){
                $product->attributeProduct()->attach($val, array('price'=>$req->price[$key], 'stock'=>$req->stock[$key], 'size_id'=>$req->size_id[$key]));
            }
    }

    public function updateAttrProduct($req, $id)
    {
        foreach($req->color_id as $key => $it){
            DB::table('products_attributes')->where('id', $req->productAttrId[$key])
            ->update([
                'color_id'=>$it,
                'size_id'=>$req->size_id[$key],
                'price'=>$req->price[$key],
                'stock'=>$req->stock[$key],
            ]);
        }
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