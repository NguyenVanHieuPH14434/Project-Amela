<?php

namespace App\Repositories\News;

use App\Constant\Constanst;
use App\Repositories\RepositoryInterface;

interface NewRepositoryInterface extends RepositoryInterface {

    public function getAllNews ();

    public function getNews ($paginate = Constanst::LIMIT_PERPAG);

    public function insertNews ($req);

    public function updateNews ($req, $id);

}