<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Permission;
use App\Models\Role;

class CategoryService {

    public function getAllCategory () {
        return Category::where('deleted_at', null)->get();
    }

    public function getPaginateCategory ($paginate = 10) {
        return  Category::where('deleted_at', null)->paginate($paginate);
    }

}
