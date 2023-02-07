<?php

namespace App\Repositories\ProductGallery;

use App\Repositories\RepositoryInterface;

interface ProductGalleryRepositoryInterface extends RepositoryInterface {

    public function insertProductGallery ($productId, $req);
    
}