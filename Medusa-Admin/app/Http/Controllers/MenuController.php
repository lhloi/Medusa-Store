<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use \App\Http\Requests\MenuAddRequest;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    public function listMenu()
    {
        $menu = Menu::orderBy('id','desc')->paginate(5);
        return view('admin.pages.menu.listMenu',compact('menu'));
    }
    public function addMenu()
    {
        $menu = Menu::all();
        return view('admin.pages.menu.addMenu',compact('menu'));
    }
    public function saveMenu(MenuAddRequest $request)
    {
        $menu = new Menu();
        $menu->name = $request->name;
        $menu->slug = $request->slug;
        $menu->parent_id = $request->parent_id;
        $menu->save();
        return redirect('admin/menu/')->with('message','Thêm menu thành công');

    }
    public function editMenu($id)
    {
        $data = Menu::find($id);
        $menu = Menu::all();
        return view('admin.pages.menu.editMenu',compact('menu','data'));
    }

    public function updateMenu(MenuAddRequest $request , $id)
    {
        $data = Menu::find($id);
        $data->name = $request->name;
        $data->slug = $request->slug;
        $data->parent_id = $request->parent_id;
        $data->save();
        return redirect('admin/menu/')->with('message','Cập nhâp danh mục thành công');
    }
    public function deleteMenu($id)
    {
        try {
            $parent = Menu::where('parent_id',$id)->get();
            if($parent->count() > 0){
                Menu::where('parent_id',$id)->delete();
            }
            Menu::find($id)->delete();
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
        return redirect()->back()->with('message','Xóa danh mục thành công');
    }
}
