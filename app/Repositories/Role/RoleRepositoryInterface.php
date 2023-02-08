<?php

namespace App\Repositories\Role;

use App\Constant\Constanst;
use App\Repositories\RepositoryInterface;

interface RoleRepositoryInterface extends RepositoryInterface {

    public function getAllRole ();

    public function getRole ($req = null, $paginate = Constanst::LIMIT_PERPAG);

    public function insertRole ($req);

    public function updateRole ($req, $id);

    public function deleteRole ($id);

}