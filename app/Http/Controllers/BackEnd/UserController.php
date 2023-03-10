<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRequest;
use App\Jobs\JobMail;
use App\Models\Profile;
use App\Models\User;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\RoleService;
use App\Services\UserService;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $roleRepo;
    public $userRepo;
    public $message;

    public function __construct(RoleRepositoryInterface $roleRepo, UserRepositoryInterface $userRepo, $message= [])
    {
        $this->roleRepo = $roleRepo;
        $this->userRepo = $userRepo;
        $this->message = $message;
    }

    public function index()
    {
        $listUser = $this->userRepo->getUser();
        return view('pages.user.list', compact('listUser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleRepo->getAllRole();
        return view('pages.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(UserRequest $req)
    {
        DB::beginTransaction();
        try {
            $this->userRepo->insertUser($req);

            $content = 'Chúng tôi đã tạo cho bạn tài khoản trên website với tài khoản là : ' . $req->username . ' , mật khẩu: ' . $req->password . 
            ' . Vui lòng không tiết lộ thông tin này cho bất kì ai.';

            dispatch(new JobMail($req->email, mailData("Thông báo đăng ký tài khoản thành công!", 'emails.sendMail', $req->full_name, $content)));
            $this->message = ['success' => 'Thêm người dùng thành công!'];
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
        $user = User::with('getProfile')->with('user_role')->findOrFail($id);
        $roles = $this->roleRepo->getAllRole();
        return view('pages.user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        DB::beginTransaction();
        try {
           $this->userRepo->updateUser($request, $id);
           $this->message = ['success' => 'Cập nhật người dùng thành công!'];
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
            $listUser = $this->serviceUser->searchUser($_GET['key']);
            return view('pages.user.list', compact('listUser'));
       }
       return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->userRepo->deleteUser($id);
            $this->message = ['success' => 'Xóa người dùng thành công!'];
            DB::commit();
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
            DB::rollBack();
        }
        return redirect()->back()->with($this->message);
    }
}
