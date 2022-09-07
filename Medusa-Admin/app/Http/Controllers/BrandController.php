<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Products;
use Redirect;
use DB;

class BrandController extends Controller
{
    public function listBrand()
    {
        $brand = Brand::orderBy('name', 'desc')->paginate(10);
        return view('admin.pages.brand.brand',compact('brand'));
    }
    public function saveBrand(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:product_color|max:255',
        ]);
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->save();
        return Redirect::back()->with('message','Thêm Thương Hiệu Thành Công');

    }

    public function editBrand($id)
    {
        $brand = Brand::orderBy('name', 'desc')->paginate(10);
        $brandById = Brand::find($id);
        return view('admin.pages.brand.brand',compact('brand','brandById'));
    }

    public function updateBrand(Request $request,$id)
    {
        $brand = Brand::orderBy('name', 'desc')->paginate(10);
        $request->validate([
            'name' => 'required|unique:product_color|max:255',
        ]);
        $brandById = Brand::find($id);
        $brandById->name = $request->name;
        $brandById->slug = $request->slug;
        $brandById->save();
        return redirect('admin/brand')->with('brand',$brand)->with('message','Cập Nhập Thương Hiệu Thành Công');
    }
    public function deleteBrand($id)
    {
        try {
            DB::beginTransaction();
            Products::where('brand_id',$id)->delete();
            Brand::find($id)->delete();
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'success'
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
        // return redirect()->back()->with('message','Xóa danh mục thành công');
    }
}
