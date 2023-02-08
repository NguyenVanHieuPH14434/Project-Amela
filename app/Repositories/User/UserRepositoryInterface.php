<?php

namespace App\Repositories\User;

use App\Constant\Constanst;
use App\Repositories\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface {

    public function getAllUser ();

    public function getUser ($paginate = Constanst::LIMIT_PERPAG);

    public function insertUser ($req);

    public function updateUser ($req, $id);

    public function deleteUser ($id);
    
}