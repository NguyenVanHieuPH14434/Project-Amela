<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use App\Repositories\NewCategory\NewCategoryRepositoryinterface;
use App\Repositories\News\NewRepositoryInterface;
use App\Services\CategoryNewService;
use App\Services\NewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $newRepo;
    public $newCateRepo;
    public $message = [];
    public function __construct(NewRepositoryInterface $newRepo, NewCategoryRepositoryinterface $newCateRepo)
    {
        $this->newRepo = $newRepo;
        $this->newCateRepo = $newCateRepo;
    }
    public function index()
    {
        $listNew = $this->newRepo->getNews();
        return view('pages.new.list', compact('listNew'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cateNews = $this->newCateRepo->getAllNewCategory();
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
        DB::beginTransaction();
        try {
            $this->newRepo->insertNews($request);
            $this->message = ['success' => 'Thêm bài viết thành công!'];
            DB::commit();
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
            DB::rollBack();
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
        $cateNews = $this->newCateRepo->getAllNewCategory();
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
        DB::beginTransaction();
        try {
            $this->newRepo->updateNews($request, $id);
            $this->message = ['success' => 'Cập nhật bài viết thành công!'];
            DB::commit();
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
            DB::rollBack();
        }
        return redirect()->back()->with($this->message);
    }

    public function search (Request $request) {
      if($_GET['key'] && $_GET['key'] != ''){
            $listNew = $this->newRepo->search($_GET['key'], ['new_title']);
            return view('pages.new.list', compact('listNew'));
      }
      return redirect()->route('news.index');
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
            $this->newRepo->deleteNews($id);
            $this->message = ['success' => 'Xóa bài viết thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }
}
