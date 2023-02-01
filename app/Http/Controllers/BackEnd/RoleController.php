<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $serviceRole;
    public $message = [];
    public function __construct(RoleService $serviceRole)
    {
        $this->serviceRole = $serviceRole;
    }
    public function index()
    {
        $listRole = $this->serviceRole->getPaginateRole();
        return view('pages.role.list', compact('listRole'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissionParent = Permission::where('parent_id', 0)->get();
        return view('pages.role.create', compact('permissionParent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        DB::beginTransaction();
       try {

         $role = new Role();
         $role->fill($request->all());
         $role->role_key = Str::lower($request->role_name);
         $role->save();

         $role->permission_role()->attach($request->permission_id);

         $this->message = ['success'=>'Thêm vai trò thành công!'];
         DB::commit();
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error'=>'Error: '.$err->getMessage()];
            DB::rollBack();
        }
        return redirect()->route('roles.create')->with($this->message);
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
        $role = Role::findOrFail($id);
        $permissionParent = Permission::where('parent_id', 0)->get();
        return view('pages.role.edit', compact('role', 'permissionParent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
            DB::beginTransaction();
        try {
            $role = Role::findOrFail($id);
            $role->fill($request->all());
            $role->role_key = Str::lower($request->role_name);
            $role->update();
            $role->permission_role()->sync($request->permission_id);
            $this->message = ['success'=>'Cập nhật vai trò thành công!'];
            DB::commit();
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error'=>'Error: '.$err->getMessage()];
            DB::rollBack();
        }
        return redirect()->back()->with($this->message);
    }

    public function search (Request $request) {
        $listRole =  $this->serviceRole->searchRole($_GET['key']);
        return view('pages.role.list', compact('listRole'));
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
            $this->serviceRole->deleteRole($id);
            $this->message = ['success'=>'Xóa vai trò thành công!'];
            DB::commit();
        }catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error'=>'Error: '.$err->getMessage()];
            DB::rollBack();
        }
        return redirect()->back()->with($this->message);
    }
}
