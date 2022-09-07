<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use \App\Http\Requests\CategoryAddRequest;
use Illuminate\Support\Facades\Log;
class CategoryController extends Controller
{
    public function listCategory()
    {
        $cate = Category::orderBy('id','desc')->paginate(10);
        return view('admin.pages.category.listCategory',compact('cate'));
    }
    public function addCategory()
    {
        $cate = Category::all();
        return view('admin.pages.category.addCategory',compact('cate'));
    }
    public function saveCategory(CategoryAddRequest $request)
    {
        $cate = new Category();
        $cate->name = $request->name;
        $cate->slug = $request->slug;
        $cate->parent_id = $request->parent_id;
        $cate->save();
        return redirect('admin/category/')->with('message','Thêm danh mục thành công');

    }
    public function editCategory($id)
    {
        $data = Category::find($id);
        $cate = Category::all();
        return view('admin.pages.category.editCategory',compact('cate','data'));
    }

    public function updateCategory(CategoryAddRequest $request , $id)
    {
        $data = Category::find($id);
        $data->name = $request->name;
        $data->slug = $request->slug;
        $data->parent_id = $request->parent_id;
        $data->save();
        return redirect('admin/category/')->with('message','Cập nhâp danh mục thành công');
    }
    public function deleteCategory($id)
    {
        try {
            $parent = Category::where('parent_id',$id)->get();
            if($parent->count() > 0){
                Category::where('parent_id',$id)->delete();
            }
            Category::find($id)->delete();

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
        return redirect()->back()->with('message','Xóa danh mục thành công');
    }
}
