<?php

namespace App\Repositories\Category;

use App\Constant\Constanst;
use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface {

    public function getAllCategory ();

    public function getCategory ($req = null, $paginate = Constanst::LIMIT_PERPAG);

    public function insertCategory ($req);

    public function updateCategory ($req, $id);

    public function deleteCategory ($id);

}