<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryNewRequest;
use App\Models\CategoryNew;
use App\Services\CategoryNewService;
use Illuminate\Http\Request;

class CategoryNewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $serviceCategoryNew;
    public $message = [];
    public function __construct(CategoryNewService $serviceCategoryNew)
    {
        $this->serviceCategoryNew = $serviceCategoryNew;
    }
    public function index()
    {
        $listCateNew = $this->serviceCategoryNew->getPaginateCategoryNew();
        return view('pages.categoryNew.list', compact('listCateNew'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.categoryNew.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryNewRequest $request)
    {
        // dd($request->all());
        try {
            $this->serviceCategoryNew->insertCategoryNew($request);
            $this->message = ['success' => 'Thêm danh mục bài viết thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
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
        $cateNew = CategoryNew::findOrFail($id);
        return view('pages.categoryNew.edit', compact('cateNew'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryNewRequest $request, $id)
    {
        try {
            $this->serviceCategoryNew->updateCategoryNew($request, $id);
            $this->message = ['success' => 'Cập nhật danh mục bài viết thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }

    public function search (Request $request) {
        $listCateNew = $this->serviceCategoryNew->searchCategoryNew($_GET['key']);
        return view('pages.categoryNew.list', compact('listCateNew'));
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
            $this->serviceCategoryNew->deleteCategoryNew($id);
            $this->message = ['success' => 'Xóa danh mục bài viết thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }
}
