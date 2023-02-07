<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
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
    public $message = [];
    public $cateRepo;
    
    public function __construct(CategoryRepositoryInterface $cateRepo)
    {
        $this->cateRepo = $cateRepo;
    }

    public function index()
    {
        $listCate = $this->cateRepo->getCategory();
        return view('pages.category.list', compact('listCate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCate = $this->cateRepo->all();
        return view('pages.category.create', compact('allCate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $this->cateRepo->insertCategory($request);
            $this->message = ['success'=>'Thêm danh mục thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error'=>'Error: '.$err->getMessage()];
        }
        return redirect()->back()->with($this->message);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cate = Category::findOrFail($id);
        $allCate = $this->cateRepo->all();
        return view('pages.category.edit', compact('cate', 'allCate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
           $this->cateRepo->updateCategory($request, $id);

            $this->message = ['success'=>'Cập nhật danh mục thành công!'];

        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error'=>'Error: '.$err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }

    // search
    public function search (Request $request) {
      if($_GET['key'] && $_GET['key'] != ''){
        $listCate = $this->cateRepo->search($_GET['key'], ['cate_name']);
        return view('pages.category.list', compact('listCate'));
      }
      return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
           $this->cateRepo->deleteCategory($id);
            $this->message = ['success'=>'Xóa danh mục thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error'=>'Error: '.$err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }
}
