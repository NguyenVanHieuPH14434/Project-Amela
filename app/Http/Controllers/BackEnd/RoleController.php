<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listRole = Role::paginate(15);
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
        $message = [];
       try {

         $role = new Role();
         $role->fill($request->all());
         $role->role_key = Str::lower($request->role_name);
         $role->save();

         $role->permission_role()->attach($request->permission_id);

         $message = ['success'=>'Create success!'];

        } catch (\Exception $err) {
            report($err->getMessage());
            $message = ['error'=>'Error: '.$err->getMessage()];
        }
        return redirect()->route('roles.create')->with($message);
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
        $message = [];
        try {
            $role = Role::findOrFail($id);
            $role->fill($request->all());
            $role->role_key = Str::lower($request->role_name);
            $role->update();

            $role->permission_role()->sync($request->permission_id);

            $message = ['success'=>'Update role success'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $message = ['error'=>'Error: '.$err->getMessage()];
        }
        return redirect()->back()->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = [];
        try {
            $role = Role::findOrFail($id);
            $role->permission_role()->detach();
            $role->delete();
            $message = ['success'=>'Delete role success'];
        }catch (\Exception $err) {
            report($err->getMessage());
            $message = ['error'=>'Error: '.$err->getMessage()];
        }
        return redirect()->back()->with($message);
    }
}
