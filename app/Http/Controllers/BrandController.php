<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function AllBrand(){
        $brand = Brand::latest()->get();
        return view('backend.brand.brand_all',compact('brand'));
    }

    public function StoreBrand(Request $request){
        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_fr' => 'required',
            'brand_image' => 'required',
        ],[
            'brand_name_en.required' => 'The brand name is required',
            'brand_name_fr.required' => 'The brand name is required',
            'brand_image.required' => 'The brand image required',
        ]);

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  
        Image::make($image)->resize(166,110)->save('upload/brand/'.$name_gen);
        $url_image = 'upload/brand/'.$name_gen;

        Brand::insert([
            'brand_name_en' => $request->brand_name_en,
            'brand_name_fr' => $request->brand_name_fr,
            //strtolower va remplacer toutes les majuscules en minuscules
            //str_replace va remplacer les espaces par des tiret -
            'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)),
            'brand_slug_fr' => strtolower(str_replace(' ','-',$request->brand_name_en)),
            'brand_image' => $url_image,
        ]);

        $notification = array(
            'message' => 'Brand added successfuly', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditBrand($id){
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit',compact('brand'));
    }

    public function UpdateBrand(Request $request){

        $request->validate([
            'brand_name_en' => 'required',
            'brand_name_fr' => 'required',
        ],[
            'brand_name_en.required' => 'The brand name is required',
            'brand_name_fr.required' => 'The brand name is required',
        ]);

        if($image = $request->file('brand_image')){
            $image_del = Brand::findOrFail($request->id)->brand_image;
            //unlink($image_del);   marche aussu kifkif
            @unlink(public_path($image_del));

            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();  
            Image::make($image)->resize(166,110)->save('upload/brand/'.$name_gen);
            $url_image = 'upload/brand/'.$name_gen;

            Brand::findOrFail($request->id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_fr' => $request->brand_name_fr,
                'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)),
                'brand_slug_fr' => strtolower(str_replace(' ','-',$request->brand_name_en)),
                'brand_image' => $url_image,
            ]);
        }
        else{
            Brand::findOrFail($request->id)->update([
                'brand_name_en' => $request->brand_name_en,
                'brand_name_fr' => $request->brand_name_fr,
                'brand_slug_en' => strtolower(str_replace(' ','-',$request->brand_name_en)),
                'brand_slug_fr' => strtolower(str_replace(' ','-',$request->brand_name_en)),
            ]);
        }
        $notification = array(
            'message' => 'Brand updated successfuly', 
            'alert-type' => 'success'
        );
        return redirect()->route('all.brand')->with($notification);
    }

    public function DeleteBrand($id){
        $brand = Brand::findOrFail($id);
        $image_del = $brand->brand_image;
        @unlink(public_path($image_del));
        $brand->delete();
        $notification = array(
            'message' => 'Brand deleted successfuly', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
