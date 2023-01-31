<?php

namespace App\Services;

use App\Models\Attribute;
use App\Models\Permission;
use App\Models\Product;
use App\Models\ProductGallery;

class ProductGalleryService {


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
