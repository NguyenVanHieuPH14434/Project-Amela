<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $serviceCategory;
    public $cateRepo;
    public function __construct(CategoryService $serviceCategory, CategoryRepositoryInterface $cateRepo)
    {
        $this->serviceCategory = $serviceCategory;
        $this->cateRepo = $cateRepo;
    }

    public function index(Request $req)
    {
        $listCate = $this->cateRepo->getCategory($req, $req->perPage??$req->perPage);
        // $listCate = $this->serviceCategory->getPaginateCategory($req->perPage??$req->perPage);
        return response()->json([
            "success"=>true,
            "message"=>"Danh sách danh mục sản phẩm!",
            "data"=>$listCate
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
