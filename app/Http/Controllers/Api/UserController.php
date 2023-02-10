<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserApiRequest;
use App\Http\Requests\UserRequest;
use App\Jobs\JobMail;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $serviceUser;

    public function __construct(UserService $serviceUser)
    {
        $this->serviceUser = $serviceUser;
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
    public function store(UserApiRequest $request)
    {

        try {
           $data = $this->serviceUser->insertUser($request);

           $content = 'Chúng tôi đã tạo cho bạn tài khoản trên website với tài khoản là : ' . $request->username . ' , mật khẩu: ' . $request->password . 
            ' . Vui lòng không tiết lộ thông tin này cho bất kì ai.';

            dispatch(new JobMail($request->email, mailData("Thông báo đăng ký tài khoản thành công!", $request->full_name, $content)));
            
            return response()->json([
                'success'=> true,
                'message'=> 'Đăng ký người dùng thành công!',
                'data'=> $data,
            ], 200);
        } catch (\Exception $err) {
            report($err->getMessage());
            return response()->json([
                'success'=> false,
                'error'=> 'Đã xảy ra lỗi!'. $err->getMessage(),
            ], 500);
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
        try {
           $data = $this->serviceUser->updateUser($request, $id);
            return response()->json([
                'success'=> true,
                'message'=> 'Cập nhật thông tin thành công!',
                'data'=> $data,
            ], 200);
        } catch (\Exception $err) {
            report($err->getMessage());
            return response()->json([
                'success'=> false,
                'error'=> 'Đã xảy ra lỗi!'. $err->getMessage(),
            ], 500);
        }
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
