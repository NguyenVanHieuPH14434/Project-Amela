<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Replies\RepliesRepositoryInterface;
use App\Services\RepliesService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $replieService;
    protected $replieRepo;
    public function __construct(RepliesService $replieService, RepliesRepositoryInterface $replieRepo)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->replieService = $replieService;
        $this->replieRepo = $replieRepo;
    }
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->replieRepo->insertReplies($request);
            return response()->json([
                "success"=>true,
            ], Response::HTTP_CREATED);
        } catch (\Throwable $err) {
           report($err->getMessage());
           return response()->json([
            "success"=>false,
            "message"=>"Đã xảy ra lỗi!"
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
