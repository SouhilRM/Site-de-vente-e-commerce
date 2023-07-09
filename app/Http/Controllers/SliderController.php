<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function AllSlider(){
        $slider = Slider::latest()->get();
        return view('backend.slider.slider_all',compact('slider'));
    }//end function

    public function StoreSlider(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'slider_img' => 'required',
        ],[
            'title.required' => 'The slider name is required',
            'description.required' => 'The slider name is required',
            'slider_img.required' => 'The slider image required',
        ]);

        $image = $request->file('slider_img');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  
        Image::make($image)->resize(870,370)->save('upload/slider/'.$name_gen);
        $url_image = 'upload/slider/'.$name_gen;

        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'slider_img' => $url_image,
        ]);

        $notification = array(
            'message' => 'Slider added successfuly', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }//end function

    public function EditSlider($id){
        $slider = Slider::findOrFail($id);
        return view('backend.slider.slider_edit',compact('slider'));
    }//end function

    public function UpdateSlider(Request $request){

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ],[
            'title.required' => 'The slider name is required',
            'description.required' => 'The slider name is required',
        ]);

        if($image = $request->file('slider_img')){
            $image_del = Slider::findOrFail($request->id)->slider_img;
            @unlink(public_path($image_del));

            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  
            Image::make($image)->resize(870,370)->save('upload/slider/'.$name_gen);
            $url_image = 'upload/slider/'.$name_gen;

            Slider::findOrFail($request->id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'slider_img' => $url_image,
            ]);
        }
        else{
            Slider::findOrFail($request->id)->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
        }
        $notification = array(
            'message' => 'Slider updated successfuly', 
            'alert-type' => 'success'
        );
        return redirect()->route('all.slider')->with($notification);
    }//end function

    public function DeleteSlider($id){
        @unlink(public_path(Slider::findOrFail($id)->slider_img));
        Slider::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Slider deleted successfuly', 
            'alert-type' => 'success'
        );
        return redirect()->route('all.slider')->with($notification);
    }//end function

    public function InActiveSlider($id){
        Slider::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Slider Status Updated', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }//end function

    public function ActiveSlider($id){
        Slider::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Slider Status Updated', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }//end function
}
