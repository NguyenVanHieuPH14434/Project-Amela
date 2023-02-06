<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginApiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function login(LoginApiRequest $request)
    {

        $credentials = $request->only('username', 'password');

        $token = Auth::guard('api')->setTTL(1440)->attempt($credentials);

        if (!$token) {
            return response()->json([
                'success'=>false,
                'message' => 'Tài khoản hoặc mật khẩu không đúng!',
            ], 401);
        }

        $user = Auth::guard('api')->user();
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                    'expired' => Auth::guard('api')->factory()->getTTL()
                ]
            ], 200);

    }

    // get info user
    public function profile () {
        $account = Auth::guard('api')->user();
        return response()->json([
            'success'=>true,
            'message'=>'Thông tin cá nhân',
            'data'=> $account->getProfile
        ]);
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::guard('api')->user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

}
