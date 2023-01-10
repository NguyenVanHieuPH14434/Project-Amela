<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
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
    public $serviceCategory;
    public function __construct(CategoryService $serviceCategory)
    {
        $this->serviceCategory = $serviceCategory;
    }

    public function index()
    {
        $listCate = $this->serviceCategory->getPaginateCategory();
        return view('pages.category.list', compact('listCate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allCate = Category::all(['id', 'cate_name']);
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
            $dataImage = checkIssetImage($request, [
                'image'=>'cate_image',
                'prefixName'=>'category',
                'folder'=>'uploads/categories',
                'imageOld'=>''
            ]);
            $cate = new Category();
            $cate->fill($request->all());
            $cate->cate_image = $dataImage;
            $cate->save();

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
        $allCate = Category::all(['id', 'cate_name']);
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
            $cate = Category::findOrFail($id);
            $cate->fill($request->all());
            $dataImage = checkIssetImage($request, [
            'image'=>'cate_image',
            'prefixName'=>'category',
            'folder'=>'uploads/categories',
            'imageOld'=> $cate->cate_image,
            ]);
            $cate->cate_image = $dataImage;
            $cate->update();

            $this->message = ['success'=>'Cập nhật danh mục thành công!'];

        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error'=>'Error: '.$err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }

    // search
    public function search (Request $request) {
        $listCate = $this->serviceCategory->searchCategory($_GET['key']);
        return view('pages.category.list', compact('listCate'));
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
           $this->serviceCategory->deleteCategory($id);
            $this->message = ['success'=>'Xóa danh mục thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error'=>'Error: '.$err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }
}
