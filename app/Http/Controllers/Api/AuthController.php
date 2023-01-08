<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $serviceRole;
    public function __construct(RoleService $serviceRole)
    {
        // $this->middleware('auth:api');
        $this->serviceRole = $serviceRole;
    }
    public function index()
    {
        $token= request()->bearerToken();
        $veryToken = User::where('remember_token', $token)->first();
        if($token){
            if($veryToken){
                return response()->json([
                    "data"=> $this->serviceRole->getAllRole(),
                    "token"=> $token,
                    "user"=> $veryToken
                ], 200);
            }else{
                return response()->json([
                    "success"=>false,
                    "message"=>"Token not found",
                    // "data"=> $token
                ], 401);
            }

        }
        return response()->json([
            "success"=>false,
            "message"=>"Unauthorized",
            // "data"=> $token
        ], 401);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        return response()->json([
            'success'=> true,
            'message'=> 'Đăng ký người dùng thành công!',
            'data'=> $request->username,
        ], 200);
        // 422 => error validate
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
