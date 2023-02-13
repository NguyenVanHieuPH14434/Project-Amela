<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $commnetRepo;
    public function __construct(CommentRepositoryInterface $commnetRepo)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->commnetRepo = $commnetRepo;
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
            $this->commnetRepo->insertComment($request);
            return response()->json([
                "success"=>true,
            ], Response::HTTP_CREATED);
        } catch (\Throwable $err) {
           report($err->getMessage());
           return response()->json([
            "success"=>false,
            "message"=>"Đã xảy ra lỗi!" .$err->getMessage()
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
