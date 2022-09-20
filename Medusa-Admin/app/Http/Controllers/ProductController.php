<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\ProductAddRequest;
use App\Models\Products;
use App\Models\Product_Images;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Tags;
use App\Models\Coupon;
use App\Models\Product_Tags;
use App\Models\Product_color;
use App\Models\product_stock;
use App\Models\Product_size;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Log;
use Redirect;
use DB;

class ProductController extends Controller
{
    use StorageImageTrait;
    public function listProduct()
    {
        $product = Products::orderBy('Products.id','desc')
        ->leftJoin('categories','categories.id','category_id')
        ->select('categories.name as catename','Products.*')
        ->paginate(10);
        // print_r($product);
        return view('admin.pages.product.listProduct',compact('product'));
    }
    public function addProduct()
    {
        $cate = Category::all();
        $brand = Brand::all();
        $tags = Tags::all();
        $color = Product_color::all();
        $size = Product_size::all();
        return view('admin.pages.product.addProduct',compact('cate','tags','color','size','brand'));
    }

    public function saveProduct(Request $request)
    {
        try {
            DB::beginTransaction();
            $product = new Products();
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->price = $request->price;
            $product->content = $request->content;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->user_id =auth()->user()->id;
            $dataImageProduct = $this->storageTraitUpload( $request,'feature_image_path','product' );
            if(!empty($dataImageProduct)){
                $product->feature_image_path = $dataImageProduct['file_path'];
            }
            $product->save();

            if($request->hasFile('image_path')){
                foreach($request->image_path as $key => $value){
                    $dataImageDetail = $this->storageTraitUploadMutiple($value,'product');
                    $product_image = new Product_Images();
                    $product_image->image_path = $dataImageDetail['file_path'];
                    $product_image->product_id = $product->id;
                    $product_image->save();
                }
            }

            if (!empty($request->tags)) {
                foreach($request->tags as $key=>$value){
                    $tag = Tags::firstOrCreate(['name'=>$value]);
                    // Product_tags::create([
                    //     'product_id' => $product->id,
                    //     'tag_id'    =>$tag->id
                    // ]);
                    $tagId[] = $tag->id;
                }
                $product->tags()->attach($tagId);
            }
            foreach ($request->color as $key => $value) {
                $stock = new product_stock();
                $stock->product_id = $product->id;
                $stock->color_id = $value;
                $stock->size_id = $request->size[$key];
                $stock->quantity = $request->quantity[$key];
                $stock->save();
            }


            DB::commit();
            return redirect('admin/product/')->with('message','Thêm sản phẩm thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message:".$exception->getMessage().' Line :'.$exception->getLine());
        }


    }
    public function editProduct(Request $request , $id)
    {
        $product = Products::find($id);
        $cate = Category::all();
        $brand = Brand::all();
        $color = Product_color::all();
        $size = Product_size::all();
        $img_path = product_images::where('product_id',$product->id)->get();
        $stock = product_stock::where('product_id',$product->id)->get();
        // $product_tags = product_tags::where('product_id',$product->id)->get();
        $tags = tags::all();
        $tagsOfProduct = $product->tags;
        // $tags = product_tags::where('product_id',$product->id)
        // ->leftJoin('tags','tags.id','tag_id')
        // ->select('tags.*')
        // ->get();
        // print($tags);
        return view('admin.pages.product.editProduct',compact('product','cate','img_path','tags','tagsOfProduct','color','size','stock','brand'));
    }

    public function updateProduct(Request $request , $id)
    {

        try {
            DB::beginTransaction();
            $product = Products::find($id);
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->price = $request->price;
            $product->content = $request->content;
            // $product->content = str_replace('<img src="','<img src="http://127.0.0.1:8081',$request->content);
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->user_id = auth()->user()->id;
            $dataImageProduct = $this->storageTraitUpload( $request,'feature_image_path','product' );
            if(!empty($dataImageProduct)){
                if (!empty($product->feature_image_path)){
                    unlink(public_path($product->feature_image_path));
                }
                $product->feature_image_path = $dataImageProduct['file_path'];
            }
            $product->save();

            if($request->hasFile('image_path')){
                // xóa ảnh củ ở database và file ảnh
                $product_img_dlt = Product_Images::where('product_id',$id)->get();
                foreach($product_img_dlt as $key => $value){
                    unlink(public_path($value->image_path));
                    $value->delete();
                }
                //tạo ảnh mới
                foreach($request->image_path as $key => $value){
                    $dataImageDetail = $this->storageTraitUploadMutiple($value,'product');
                    $product_image = new Product_Images();
                    $product_image->image_path = $dataImageDetail['file_path'];
                    $product_image->product_id = $product->id;
                    $product_image->save();
                }
            }

            if (!empty($request->tags)) {
                Product_tags::where('product_id',$id)->delete();
                foreach($request->tags as $key=>$value){
                    $tag = Tags::firstOrCreate(['name'=>$value]);
                    // Product_tags::create([
                    //     'product_id' => $product->id,
                    //     'tag_id'    =>$tag->id
                    // ]);
                    $tagId[] = $tag->id;
                }
                $product->tags()->sync($tagId);
            }
            $stock = product_stock::where('product_id',$product->id)->get();
            if ($stock->count()>'0') {
                product_stock::where('product_id',$product->id)->delete();
            }
            foreach ($request->color as $key => $value) {
                $stock = new product_stock();
                $stock->product_id = $product->id;
                $stock->color_id = $value;
                $stock->size_id = $request->size[$key];
                $stock->quantity = $request->quantity[$key];
                $stock->save();
            }


            DB::commit();
            return redirect('admin/product/')->with('message','Cập nhâp danh mục thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("message:".$exception->getMessage().' Line :'.$exception->getLine());
        }


    }
    public function deleteProduct($id)
    {
        try {
            DB::beginTransaction();

            $product = Products::find($id);
            if (!empty($product->feature_image_path)){
                unlink(public_path($product->feature_image_path));
            }
            $product_img_dlt = Product_Images::where('product_id',$id)->get();
            foreach($product_img_dlt as $key => $value){
                unlink(public_path($value->image_path));
                $value->delete();
            }
            Product_tags::where('product_id',$id)->delete();
            $product->delete();

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

    // =============================  Color  =====================================
    public function listProductColor()
    {
        $color = product_color::orderBy('name', 'desc')->paginate(10);
        return view('admin.pages.productColor.listProductColor',compact('color'));
    }

    public function saveProductColor(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:product_color|max:255',
            'code_color' => 'required',
        ]);
        $color = new product_color();
        $color->name = $request->name;
        $color->slug = $request->slug;
        $color->description = $request->description;
        $color->code_color = $request->code_color;
        $color->save();
        return Redirect::back()->with('message','Thêm màu thành công');

    }
    public function deleteProductColor($id)
    {
        try {
            DB::beginTransaction();

            product_stock::where('color_id',$id)->delete();
            product_color::find($id)->delete();
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

    // =============================  Size  ======================================
    public function listProductSize()
    {
        $size = product_size::all();
        return view('admin.pages.productSize.listProductSize',compact('size'));
    }

    public function saveProductSize(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:product_size|max:255',
            'slug' => 'required',
        ]);
        $size = new product_size();
        $size->name = $request->name;
        $size->slug = $request->slug;
        $size->description = $request->description;
        $size->save();
        return Redirect::back()->with('message','Thêm Size thành công');

    }
    public function deleteProductSize($id)
    {
        try {
            product_size::find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ],200);

        } catch (\Exception $exception) {
            Log::error("message:".$exception->getMessage().' Line :'.$exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ],500);
        }


    }
    // =============================  Coupon  ======================================
    public function listCoupon()
    {
        $coupon = Coupon::all();
        return view('admin.pages.Coupon.listCoupon',compact('coupon'));
    }

    public function saveCoupon(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:coupon|max:255',
            'code' => 'required|unique:coupon|min:5|max:10',
            'condition' => 'required',
            'quantity' => 'required',
            'number' => 'required',
        ]);
        $coupon = new Coupon();
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->condition = $request->condition;
        $coupon->quantity = $request->quantity;
        $coupon->number = $request->number;
        $coupon->save();
        return Redirect::back()->with('message','Thêm coupon thành công');

    }
    public function editCoupon($id)
    {
        $couponById = Coupon::find($id);
        $coupon = Coupon::all();
        return view('admin.pages.Coupon.listCoupon',compact('coupon','couponById'));
    }
    public function updateCoupon(Request $request,$id)
    {

        $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|min:5|max:10',
            'condition' => 'required',
            'quantity' => 'required',
            'number' => 'required',
        ]);
        $coupon = Coupon::find($id);
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->condition = $request->condition;
        $coupon->quantity = $request->quantity;
        $coupon->number = $request->number;
        $coupon->save();
        return Redirect::to('/admin/product/coupon')->with('message','Cập nhập coupon thành công');

    }

    public function deleteCoupon($id)
    {
        try {
            Coupon::find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ],200);

        } catch (\Exception $exception) {
            Log::error("message:".$exception->getMessage().' Line :'.$exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ],500);
        }


    }


}
