<?php

namespace App\Repositories\Permission;

use App\Constant\Constanst;
use App\Repositories\RepositoryInterface;

interface PermissionRepositoryInterface extends RepositoryInterface {

    public function getAllPermission ();

    public function getPermission ($req = null, $paginate = Constanst::LIMIT_PERPAG);

    public function insertPermission ($pmsName, $pmsKey=' ', $parentId=Constanst::PARENT);

    public function updatePermission ($id, $pmsName);

    public function deletePermission ($id);

    public function searchPermission ($key, $columns=[]);
}