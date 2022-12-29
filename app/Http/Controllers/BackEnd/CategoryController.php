<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listCate = Category::paginate(15);
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
        $message = [];
        try {
            $cate = new Category();
            $cate->fill($request->all());
            if($request->hasFile('cate_image')){
                $file = $request->file('cate_image');
                $cate->cate_image = fileUpload($file, 'category', 'uploads/categories');
            }else{
                $cate->cate_image = defaultImage();
            }
            $cate->save();

            $message = ['success'=>'Create category success'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $message = ['error'=>'Error: '.$err->getMessage()];
        }
        return redirect()->back()->with($message);
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
        $message = [];
        try {
            $cate = Category::findOrFail($id);
            $cate->fill($request->all());
            if($request->hasFile('cate_image')){
                $file = $request->file('cate_image');
                $cate->cate_image = fileUpload($file, 'category', 'uploads/categories');
            }else{
                $cate->cate_image = defaultImage();
            }
            $cate->update();

            $message = ['success'=>'Update category success'];

        } catch (\Exception $err) {
            report($err->getMessage());
            $message = ['error'=>'Error: '.$err->getMessage()];
        }
        return redirect()->back()->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = [];
        try {
            $cate = Category::findOrFail($id);
            $cate->cate_product()->detach();
            $cate->delete();
            $message = ['success'=>'Delete category success'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $message = ['error'=>'Error: '.$err->getMessage()];
        }
        return redirect()->back()->with($message);
    }
}
