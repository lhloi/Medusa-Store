<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\SliderAddRequest;
use App\Models\Slider;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Log;
class SliderController extends Controller
{
    use StorageImageTrait;
    public function listSlider()
    {
        $slider = Slider::orderBy('id','desc')->paginate(10);
        // print_r($product);
        return view('admin.pages.slider.listSlider',compact('slider'));
    }
    public function addSlider()
    {

        return view('admin.pages.slider.addSlider');
    }

    public function saveSlider(SliderAddRequest $request)
    {
        try {
            $slider = new Slider();
            $slider->name = $request->name;
            $slider->description = $request->description;
            $slider->status =  $request->status;
            $dataImageSlider = $this->storageTraitUpload( $request,'image_path','slider' );
            if(!empty($dataImageSlider)){
                $slider->image_path = $dataImageSlider['file_path'];
            }
            $slider->save();
            return redirect('admin/slider/')->with('message','Thêm slider thành công');

        } catch (\Exception $exception) {

            Log::error("message:".$exception->getMessage().' Line :'.$exception->getLine());
        }
    }
    public function editSlider($id)
    {
        $slider = Slider::find($id);
        return view('admin.pages.slider.editSlider',compact('slider'));
    }

    public function updateSlider(Request $request , $id)
    {

        try {
            $slider = Slider::find($id);
            $slider->name = $request->name;
            $slider->description = $request->description;
            $slider->status =  $request->status;
            $dataImageSlider = $this->storageTraitUpload( $request,'image_path','slider' );
            if(!empty($dataImageSlider)){
                if (!empty($slider->image_path)){
                    unlink(public_path($slider->image_path));
                }
                $slider->image_path = $dataImageSlider['file_path'];
            }
            $slider->save();

            return redirect('admin/slider/')->with('message','Cập nhập slider thành công');
        } catch (\Exception $exception) {
            Log::error("message:".$exception->getMessage().' Line :'.$exception->getLine());
        }


    }
    public function deleteSlider($id)
    {
        try {

            $slider = Slider::find($id)->delete();
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
        return redirect()->back()->with('message','Xóa Slider thành công');
    }
}
