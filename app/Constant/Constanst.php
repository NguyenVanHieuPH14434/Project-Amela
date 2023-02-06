<?php

namespace App\Constant;

class Constanst {
    const ACTIVE = 1;
    const ROLE_USER = 2;
    const PARENT = 0;
    const LIMIT_PERPAG = 10;
    const BASE_URL = 'http://project-amela.net/';
    const DASHBOARD_URL = self::BASE_URL . 'admin/dashboard'; 
    const PERMISSION_URL = self::BASE_URL . 'admin/permissions'; 
    const CREATE_PERMISSION_URL = self::BASE_URL . 'admin/permissions/create'; 
    const ROLE_URL = self::BASE_URL . 'admin/roles'; 
    const CREATE_ROLE_URL = self::BASE_URL . 'admin/roles/create'; 
    const CATEGORY_URL = self::BASE_URL . 'admin/categories'; 
    const CREATE_CATEGORY_URL = self::BASE_URL . 'admin/categories/create'; 
    const ATTRIBUTE_URL = self::BASE_URL . 'admin/attributes'; 
    const CREATE_ATTRIBUTE_URL = self::BASE_URL . 'admin/attributes/create'; 
    const USER_URL = self::BASE_URL . 'admin/users'; 
    const CREATE_USER_URL = self::BASE_URL . 'admin/users/create'; 
    const PRODUCT_URL = self::BASE_URL . 'admin/products'; 
    const CREATE_PRODUCT_URL = self::BASE_URL . 'admin/products/create'; 
    const NEW_CATEGORY_URL = self::BASE_URL . 'admin/categoryNews'; 
    const NEW_URL = self::BASE_URL . 'admin/news'; 
}