<?php

namespace App\Repositories\Attribute;

use App\Constant\Constanst;
use App\Repositories\RepositoryInterface;

interface AttributeRepositoryInterface extends RepositoryInterface {

    public function getAllAttribute ();

    public function getAttribute ($paginate = Constanst::LIMIT_PERPAG);

    public function insertAttribute ($req);
    
    public function updateAttribute ($req, $id);

    public function deleteAttribute ($id);

    public function searchAttribute ($key, $columns=[]);

}