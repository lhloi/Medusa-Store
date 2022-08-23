<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Log;
use DB;
class AdminPermissionController extends Controller
{
    public function addPermission()
    {

        return view('admin.pages.Permission.addPermission');
    }

    public function savePermission(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $permission_parent = new Permission();
            $permission_parent->name = $request->module_parent;
            $permission_parent->display_name = $request->module_parent;
            $permission_parent->parent_id = 0;
            $permission_parent->save();

            foreach ($request->module_childrent as $key => $value) {
                $permission = new Permission();
                $permission->name = $value;
                $permission->display_name = $value;
                $permission->parent_id = $permission_parent->id;
                $permission->key_code = $value.'-'.$request->module_parent;
                $permission->save();
            }
            // $role->permission()->attach($request->permission_id);
            DB::commit();
            return redirect('admin/permission/add-permission')->with('message','Thêm role thành công');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message:".$exception->getMessage().' Line :'.$exception->getLine());
        }
    }

}
