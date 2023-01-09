<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Permission;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

            Category::factory(10)->create();
            Product::factory(10)->create();
            $this->pivotProductCategory();
            $this->createPermission();
            $this->createRole();
            $this->createRolePermissionFactory();
            $this->creatProfile();
            $this->creatUser();
            $this->userRole();

    }

    public function pivotProductCategory () {
        DB::insert('insert into categories_products (cate_id, product_id) values (2, 1)');
        DB::insert('insert into categories_products (cate_id, product_id) values (2, 2)');
        DB::insert('insert into categories_products (cate_id, product_id) values (5, 3)');
        DB::insert('insert into categories_products (cate_id, product_id) values (2, 4)');
        DB::insert('insert into categories_products (cate_id, product_id) values (1, 5)');
        DB::insert('insert into categories_products (cate_id, product_id) values (2, 6)');
        DB::insert('insert into categories_products (cate_id, product_id) values (3, 7)');
        DB::insert('insert into categories_products (cate_id, product_id) values (3, 8)');
        DB::insert('insert into categories_products (cate_id, product_id) values (2, 9)');
        DB::insert('insert into categories_products (cate_id, product_id) values (2, 10)');
    }

    public function createPermission () {
        DB::table('permissions')->delete();
        $permissions = [
                ['pms_name'=>'Role', 'pms_key'=>'', 'parent_id'=>0],
                ['pms_name'=>'Role add', 'pms_key'=>'Role_add', 'parent_id'=>1],
                ['pms_name'=>'Role edit', 'pms_key'=>'Role_edit', 'parent_id'=>1],
                ['pms_name'=>'Role delete', 'pms_key'=>'Role_delete', 'parent_id'=>1],
                ['pms_name'=>'Role list', 'pms_key'=>'Role_list', 'parent_id'=>1],
                ['pms_name'=>'Permission', 'pms_key'=>'', 'parent_id'=>0],
                ['pms_name'=>'Permission add', 'pms_key'=>'Permission_add', 'parent_id'=>6],
                ['pms_name'=>'Permission edit', 'pms_key'=>'Permission_edit', 'parent_id'=>6],
                ['pms_name'=>'Permission delete', 'pms_key'=>'Permission_delete', 'parent_id'=>6],
                ['pms_name'=>'Permission list', 'pms_key'=>'Permission_list', 'parent_id'=>6],
                ['pms_name'=>'Attribute', 'pms_key'=>'', 'parent_id'=>0],
                ['pms_name'=>'Attribute add', 'pms_key'=>'Attribute_add', 'parent_id'=>11],
                ['pms_name'=>'Attribute edit', 'pms_key'=>'Attribute_edit', 'parent_id'=>11],
                ['pms_name'=>'Attribute delete', 'pms_key'=>'Attribute_delete', 'parent_id'=>11],
                ['pms_name'=>'Attribute list', 'pms_key'=>'Attribute_list', 'parent_id'=>11],
                ['pms_name'=>'Category', 'pms_key'=>'', 'parent_id'=>0],
                ['pms_name'=>'Category add', 'pms_key'=>'Category_add', 'parent_id'=>16],
                ['pms_name'=>'Category edit', 'pms_key'=>'Category_edit', 'parent_id'=>16],
                ['pms_name'=>'Category delete', 'pms_key'=>'Category_delete', 'parent_id'=>16],
                ['pms_name'=>'Category list', 'pms_key'=>'Category_list', 'parent_id'=>16],
                ['pms_name'=>'User', 'pms_key'=>'', 'parent_id'=>0],
                ['pms_name'=>'User add', 'pms_key'=>'User_add', 'parent_id'=>21],
                ['pms_name'=>'User edit', 'pms_key'=>'User_edit', 'parent_id'=>21],
                ['pms_name'=>'User delete', 'pms_key'=>'User_delete', 'parent_id'=>21],
                ['pms_name'=>'User list', 'pms_key'=>'User_list', 'parent_id'=>21],
                ['pms_name'=>'Product', 'pms_key'=>'', 'parent_id'=>0],
                ['pms_name'=>'Product add', 'pms_key'=>'Product_add', 'parent_id'=>26],
                ['pms_name'=>'Product edit', 'pms_key'=>'Product_edit', 'parent_id'=>26],
                ['pms_name'=>'Product delete', 'pms_key'=>'Product_delete', 'parent_id'=>26],
                ['pms_name'=>'Product list', 'pms_key'=>'Product_list', 'parent_id'=>26],

        ];
        foreach($permissions as $permission){
            Permission::create($permission);
        }
    }

    // create role
    public function createRole () {
        DB::table('roles')->delete();
        $roles = [
            ['role_name'=>'Guest', 'role_key'=>'guest'],
            ['role_name'=>'User', 'role_key'=>'user'],
            ['role_name'=>'Admin', 'role_key'=>'admin'],
        ];

        foreach($roles as $role){
            Role::create($role);
        }
    }

     // factory role_permission
     public function createRolePermissionFactory () {
        DB::table('roles_permissions')->delete();
        DB::insert('insert into roles_permissions (pms_id, role_id) values (2, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (3, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (4, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (5, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (7, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (8, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (9, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (10, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (12, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (13, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (14, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (15, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (17, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (18, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (19, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (20, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (22, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (23, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (24, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (25, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (27, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (28, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (29, 3)');
        DB::insert('insert into roles_permissions (pms_id, role_id) values (30, 3)');
    }

    // create profile
    public function creatProfile () {
        Profile::create(['full_name'=>'admin', 'phone'=>'0332525242', 'email'=>'admin@gmail.com', 'avatar'=>'images/products/default-thumbnail.jpg']);
    }

    // create user
    public function creatUser () {
        User::create(['username'=>'admin', 'password'=>Hash::make('123a123A123!'), 'is_active'=>1, 'profile_id'=>'1']);
    }

    // create user_role
    public function userRole () {
        DB::insert('insert into user_roles (user_id, role_id) values (1, 3)');
    }
}
