<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use \App\Http\Requests\AdminUserAddRequest;
use Illuminate\Support\Facades\Log;
use Hash;
use DB;
class AdminUserController extends Controller
{
    public function listUser()
    {
        $user = User::orderBy('id','desc')->paginate(10);
        return view('admin.pages.user.listUser',compact('user'));
    }
    public function addUser()
    {
        $role = Role::all();
        return view('admin.pages.user.addUser',compact('role'));
    }

    public function saveUser(AdminUserAddRequest $request)
    {
        // dd($request->role_id);
        try {
            DB::beginTransaction();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password =  Hash::make($request->password);
            $user->save();

            $user->roles()->attach($request->role_id);

            DB::commit();
            return redirect('admin/user/')->with('message','Thêm user thành công');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message:".$exception->getMessage().' Line :'.$exception->getLine());
        }
    }
    public function editUser($id)
    {
        $user = User::find($id);
        $role = Role::all();
        $roleOfUser = $user->roles;
        return view('admin.pages.user.editUser',compact('user','role','roleOfUser'));
    }

    public function updateUser(Request $request , $id)
    {

        try {
            DB::beginTransaction();
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password =  Hash::make($request->password);
            $user->save();

            $user->roles()->sync($request->role_id);

            DB::commit();
            return redirect('admin/user/')->with('message','Thêm user thành công');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message:".$exception->getMessage().' Line :'.$exception->getLine());
        }


    }
    public function deleteUser($id)
    {
        try {

            $user = User::find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Delete success'
            ],200);

        } catch (\Exception $exception) {
            Log::error("message:".$exception->getMessage().' Line :'.$exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ],500);
        }

        // Product::find($id)->delete();
        return redirect()->back()->with('message','Xóa User thành công');
    }
}
