<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\NewCategory\NewCategoryRepositoryinterface;
use App\Services\CategoryNewService;
use Illuminate\Http\Request;

class NewCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $newCateRepo;
    public function __construct(NewCategoryRepositoryinterface $newCateRepo)
    {
        $this->newCateRepo = $newCateRepo;
    }

    public function index(Request $request)
    {
        $listCateNew = $this->newCateRepo->getNewCategory(request('per_page'));
        return response()->json([
            "success"=>true,
            "message"=> "Danh sách danh mục tin tức",
            "data"=>$listCateNew
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
