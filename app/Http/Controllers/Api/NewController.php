<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\News\NewRepositoryInterface;
use App\Services\NewService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public $newRepo;
     public function __construct(NewRepositoryInterface $newRepo)
     {
         $this->newRepo = $newRepo;
     }
    public function index(Request $request)
    {
        $listNew = $this->newRepo->getNews();
        return response()->json([
            "success"=>true,
            "message"=> "Danh sách tin tức",
            "data"=>$listNew
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
        $newDetail = $this->newRepo->getNewDetail($id);
        return response()->json([
            "success"=>true,
            "message"=> "Danh sách tin tức",
            "data"=>$newDetail
        ], Response::HTTP_OK);
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
