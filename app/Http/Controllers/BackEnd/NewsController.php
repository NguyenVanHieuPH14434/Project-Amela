<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Services\CategoryNewService;
use App\Services\NewService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $serviceNew;
    public $serviceCateNew;
    public $message = [];
    public function __construct(NewService $serviceNew, CategoryNewService $serviceCateNew)
    {
        $this->serviceNew = $serviceNew;
        $this->serviceCateNew = $serviceCateNew;
    }
    public function index()
    {
        $listNew = $this->serviceNew->getPaginateNew();
        return view('pages.new.list', compact('listNew'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cateNews = $this->serviceCateNew->getAllCategoryNew();
        return view('pages.new.create', compact('cateNews'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        try {
            $this->serviceNew->insertNew($request);
            $this->message = ['success' => 'Thêm bài viết thành công!'];
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
        $new = News::with('getCateNew')->findOrFail($id);
        $cateNews = $this->serviceCateNew->getAllCategoryNew();
        return view('pages.new.edit', compact('new', 'cateNews'));
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
        try {
            $this->serviceNew->updateNew($request, $id);
            $this->message = ['success' => 'Cập nhật bài viết thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }

    public function search (Request $request) {
        $listNew = $this->serviceNew->searchNew($_GET['key']);
        return view('pages.new.list', compact('listNew'));
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
            $this->serviceNew->deleteNew($id);
            $this->message = ['success' => 'Xóa bài viết thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }
}
