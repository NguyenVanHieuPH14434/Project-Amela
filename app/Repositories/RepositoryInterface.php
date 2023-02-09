<?php

namespace App\Repositories;

interface RepositoryInterface { 

    // get all
    public function all();

    // get by id
    public function find($id);

    // create
    public function create($data = []);

    // update
    public function update($data = [], $id);

    // delete
    public function delete($id);

    // search
    public function search($key, $columns = []);

    // soft delete
    public function softDelete ($id);
}