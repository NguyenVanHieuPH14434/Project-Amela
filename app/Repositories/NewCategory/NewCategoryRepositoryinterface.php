<?php

namespace App\Repositories\NewCategory;

use App\Constant\Constanst;
use App\Repositories\RepositoryInterface;

interface NewCategoryRepositoryinterface extends RepositoryInterface {


    public function getAllNewCategory ();

    public function getNewCategory ($req = null, $paginate = Constanst::LIMIT_PERPAG);

    public function insertNewCategory ($req);

    public function updateNewCategory ($req, $id);

    public function deleteNewCategory ($id);

}