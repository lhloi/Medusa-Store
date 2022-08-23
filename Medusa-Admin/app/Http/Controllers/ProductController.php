<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\ProductAddRequest;
use App\Models\Products;
use App\Models\Product_Images;
use App\Models\Category;
use App\Models\Tags;
use App\Models\Product_Tags;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Log;
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
        $tags = Tags::all();
        // print( $tags );
        return view('admin.pages.product.addProduct',compact('cate','tags'));
    }

    public function saveProduct(ProductAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $product = new Products();
            $product->name = $request->name;
            $product->slug = $request->slug;
            $product->price = $request->price;
            $product->content = $request->content;
            $product->category_id = $request->category_id;
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
            }
            $product->tags()->attach($tagId);

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
        $img_path = product_images::where('product_id',$product->id)->get();
        // $product_tags = product_tags::where('product_id',$product->id)->get();
        $tags = tags::all();
        $tagsOfProduct = $product->tags;
        // $tags = product_tags::where('product_id',$product->id)
        // ->leftJoin('tags','tags.id','tag_id')
        // ->select('tags.*')
        // ->get();
        // print($tags);
        return view('admin.pages.product.editProduct',compact('product','cate','img_path','tags','tagsOfProduct'));
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
            $product->category_id = $request->category_id;
            $product->user_id =auth()->user()->id;
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
            }
            $product->tags()->sync($tagId);
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
}
