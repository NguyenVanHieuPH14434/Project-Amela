<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use App\Models\Role;
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
    public function index()
    {
        $listPermission = Permission::where('parent_id', 0)->paginate(1);
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
        $message = [];
        try {
            $servicePms = new PermissionService();

            $module = $servicePms->insertPermission($request->module);

            foreach ($request->action as $pms_action) {
                $pmsName = $request->module . ' ' . $pms_action;
                $pmsKey = $request->module . '_' . $pms_action;
                $servicePms->insertPermission($pmsName, $pmsKey, $module);
            }

            $message = ['message' => 'Create pms success'];
        } catch (\Throwable $err) {
            report($err->getMessage());
            $message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->route('permissions.create')->with($message);
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
        $message = [];
        try {
            $pms = Permission::findOrFail($id);

            $arrIdPmsOld = [];

            foreach($pms->getChildrentPermission as $ite){
                array_push($arrIdPmsOld, $ite->id);
            }

            $arrNewIdPms = [];

            $servicePms = new PermissionService();

            $servicePms->updatepParentPermission($id, $request->module);

            foreach ($request->action as $pms_action) {
                $pmsName = $request->module . ' ' . $pms_action;
                $pmsKey = $request->module . '_' . $pms_action;
                 $idKey = $servicePms->insertPermission($pmsName, $pmsKey, $id);
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

            $message = ['success' => 'Update success'];
        } catch (\Exception $err) {
            report($err->getMessage());
            $message = ['error' => 'Error: ' . $err->getMessage()];
        }
        return redirect()->route('permissions.edit', $id)->with($message);
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
            $pmsParent = Permission::find($id);
            $getPmsChil = $pmsParent->getChildrentPermission;
            foreach($getPmsChil as $it){
                DB::table('roles_permissions')->where('pms_id', $it->id)->delete();
            }
            $pmsParent->delete();
            $message = ['success' => 'Delete success'];
        } catch (\Exception $err) {
            report($err->getMessage());
        }
        return redirect()->back()->with($message);
    }
}
