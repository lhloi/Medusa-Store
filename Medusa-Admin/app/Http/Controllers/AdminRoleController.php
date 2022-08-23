<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\AdminRoleAddRequest;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Log;
use DB;
class AdminRoleController extends Controller
{
    public function listRole()
    {
        $role = Role::orderBy('id','desc')->paginate(10);
        return view('admin.pages.role.listRole',compact('role'));
    }
    public function addRole()
    {
        // $role = Role::all();
        $permission = Permission::Where('parent_id',0)->get();
        return view('admin.pages.Role.addRole',compact('permission'));
    }

    public function saveRole(AdminRoleAddRequest $request)
    {
        // dd($request->name);
        try {
            DB::beginTransaction();
            $role = new Role();
            $role->name = $request->name;
            $role->display_name = $request->display_name;
            $role->save();

            $role->permission()->attach($request->permission_id);

            DB::commit();
            return redirect('admin/role/')->with('message','Thêm role thành công');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message:".$exception->getMessage().' Line :'.$exception->getLine());
        }
    }
    public function editRole($id)
    {
        $role = Role::find($id);
        $permission = Permission::Where('parent_id',0)->get();
        $permissionChecked = $role->permission;
        return view('admin.pages.role.editRole',compact('role','permission','permissionChecked'));
    }

    public function updateRole(Request $request , $id)
    {

        try {
            DB::beginTransaction();
            $role = Role::find($id);
            $role->name = $request->name;
            $role->display_name = $request->display_name;
            $role->save();

            $role->permission()->sync($request->permission_id);

            DB::commit();
            return redirect('admin/role/')->with('message','Cập nhập vai trò thành công');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message:".$exception->getMessage().' Line :'.$exception->getLine());
        }


    }
    public function deleteRole($id)
    {
        try {
            DB::beginTransaction();
            $role = Role::find($id);
            DB::table('role_user')->where('role_id',$role->id)->delete();
            DB::table('permission_role')->where('role_id',$role->id)->delete();
            $role->delete();
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'Delete success'
            ],200);

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message:".$exception->getMessage().' Line :'.$exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ],500);
        }

        // Product::find($id)->delete();
        return redirect()->back()->with('message','Xóa User thành công');
    }

    // ===================================================================================

}
