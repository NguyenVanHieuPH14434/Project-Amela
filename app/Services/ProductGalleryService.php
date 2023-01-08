<?php

namespace App\Services;

use App\Models\Attribute;
use App\Models\Permission;
use App\Models\Product;
use App\Models\ProductGallery;

class ProductGalleryService {

    public function getAllProduct () {
        return Product::where('is_active', 1)->where('deleted_at', null)->get();
    }

    public function insertProductGallery ($productId, $req) {
        $files = $req->file('image');
        foreach($files as $item){
            $proGallery = new ProductGallery();
            $proGallery->product_id = $productId;
            $proGallery->path_image = fileUpload($item, 'productGallery','uploads/products');
            $proGallery->save();
        }
    }


}
