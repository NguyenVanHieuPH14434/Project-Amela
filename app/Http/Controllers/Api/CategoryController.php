<?php

namespace App\Http\Controllers\Api;

use App\Constant\Constanst;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Dashboard\DashboardRepositoryInterface;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $serviceCategory;
    public $cateRepo;
    public $dashRepo;
    public function __construct(CategoryService $serviceCategory, CategoryRepositoryInterface $cateRepo, DashboardRepositoryInterface $dashRepo)
    {
        $this->serviceCategory = $serviceCategory;
        $this->cateRepo = $cateRepo;
        $this->dashRepo = $dashRepo;
    }

    public function index(Request $req)
    {
        $listCate = $this->cateRepo->getCategory();
        return response()->json([
            "success"=>true,
            "message"=>"Danh sách danh mục sản phẩm!",
            "data"=>$listCate
        ], Response::HTTP_OK);
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
