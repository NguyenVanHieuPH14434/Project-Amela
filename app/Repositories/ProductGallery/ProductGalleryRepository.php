<?php

namespace App\Repositories\ProductGallery;

use App\Models\Product;
use App\Models\ProductGallery;
use App\Repositories\BaseRepository;

class ProductGalleryRepository extends BaseRepository implements ProductGalleryRepositoryInterface {

    public function getModel()
    {
        return ProductGallery::class;
    }

    public function insertProductGallery ($productId, $req) {
        $files = $req->file('image');
        foreach($files as $item){
            $proGallery = new $this->model();
            $proGallery->product_id = $productId;
            $proGallery->path_image = fileUpload($item, 'productGallery','uploads/products');
            $proGallery->save();
        }
    }

}