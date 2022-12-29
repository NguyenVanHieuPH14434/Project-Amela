<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

            // Category::factory(10)->create();
            // Product::factory(10)->create();
            $this->pivotProductCategory();
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
}
