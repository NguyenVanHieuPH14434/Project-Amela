<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Repositories\Permission\PermissionRepositoryInterface;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $permissionRepo;
    public $message = [];

    public function __construct(PermissionRepositoryInterface $permissionRepo)
    {
        $this->permissionRepo = $permissionRepo;
    }

    public function index()
    {
        $listPermission = $this->permissionRepo->getPermission();
        return view('pages.permission.list', compact('listPermission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(PermissionRequest $request)
    {
        DB::beginTransaction();
        try {

            $module = $this->permissionRepo->insertPermission($request->module);

            foreach ($request->action as $pms_action) {
                $pmsName = $request->module . ' ' . $pms_action;
                $pmsKey = $request->module . '_' . $pms_action;
                $this->permissionRepo->insertPermission($pmsName, $pmsKey, $module);
            }
            DB::commit();
            $this->message = ['success' => 'Thêm quyền thành công!'];
        } catch (\Throwable $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
            DB::rollBack();
        }
        return redirect()->route('permissions.create')->with($this->message);
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
        $pms = Permission::find($id);
        return view('pages.permission.edit', compact('pms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {

        DB::beginTransaction();
        try {
            $pms = Permission::findOrFail($id);

            $arrIdPmsOld = [];

            foreach($pms->getChildrentPermission as $ite){
                array_push($arrIdPmsOld, $ite->id);
            }

            $arrNewIdPms = [];

            $this->permissionRepo->updatePermission($id, $request->module);

            foreach ($request->action as $pms_action) {
                $pmsName = $request->module . ' ' . $pms_action;
                $pmsKey = $request->module . '_' . $pms_action;
                $idKey = $this->permissionRepo->insertPermission($pmsName, $pmsKey, $id);
                array_push($arrNewIdPms, $idKey);
            }

            foreach($arrIdPmsOld as $key => $valOld){
                if(!array_key_exists($key, $arrNewIdPms)){
                    DB::table('roles_permissions')->where('pms_id', $valOld)->delete();
                };
                foreach($arrNewIdPms as $newKey => $newVal){
                    if($key == $newKey){
                        DB::table('roles_permissions')->where('pms_id', $valOld)->update(['pms_id'=>$newVal]);
                    }
                }
            }
            DB::commit();
            $this->message = ['success' => 'Cập nhật quyền thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: ' . $err->getMessage()];
            DB::rollBack();
        }
        return redirect()->route('permissions.edit', $id)->with($this->message);
    }

    public function search (Request $request) {
      if($_GET['key'] && $_GET['key'] != ''){
            $listPermission = $this->permissionRepo->searchPermission($_GET['key'], ['pms_name']);
            return view('pages.permission.list', compact('listPermission'));
      }
      return redirect()->route('permissions.index');
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
           $this->permissionRepo->deletePermission($id);
            $this->message = ['success' => 'Xóa quyền thành công!'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $this->message = ['error' => 'Error: '.$err->getMessage()];
        }
        return redirect()->back()->with($this->message);
    }
}
