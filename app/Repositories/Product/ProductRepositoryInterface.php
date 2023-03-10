<?php

namespace App\Repositories\Product;

use App\Constant\Constanst;
use App\Repositories\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface {
    
    public function getAllProduct ();

    public function getProduct ($paginate = Constanst::LIMIT_PERPAG);

    public function insertProduct ($req);

    public function insertAttrProduct ($req, $id);

    public function updateProduct ($req, $id);

    public function updateAttrProduct ($req, $id);

    public function searchProduct ($textSearch);
    
}