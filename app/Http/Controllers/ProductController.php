<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategorie;
use App\Models\Categorie;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Multi_image;
use Image;
use Illuminate\Support\Carbon;
use App\Models\SubSubCategorie;

class ProductController extends Controller
{
    public function AddProduct(){
		$categorie = Categorie::latest()->get();
        $subcat = SubCategorie::latest()->get();
		$brands = Brand::latest()->get();
		return view('backend.product.product_add',compact('categorie','brands','subcat'));
	}

    public function GetSubCategory($category_id){

        $subcat = SubCategorie::where('categorie_id',$category_id)->orderBy('categorie_name_en','ASC')->get();
        return json_encode($subcat);
    }

    public function GetSubSubCategory($category_id){

        $subcat = SubSubCategorie::where('sub_categorie_id',$category_id)->orderBy('categorie_name_en','ASC')->get();
        return json_encode($subcat);
    }

    public function StoreProduct(Request $request){

        $image = $request->file('product_thambnail');

    	$name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    	Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
    	$save_url = 'upload/products/thambnail/'.$name_gen;

        $product_id = Product::insertGetId([
      	
            'categorie_id' => $request->categorie_id,
            'sub_categorie_id' => $request->sub_categorie_id,
            'sub_sub_categorie_id' => $request->sub_sub_categorie_id,

            'brand_id' => $request->brand_id,
            'product_name_en' => $request->product_name_en,
            'product_name_fr' => $request->product_name_fr,
            'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_fr' => strtolower(str_replace(' ', '-', $request->product_name_fr)),

            'product_tags_en' => $request->product_tags_en,
            'product_tags_fr' => $request->product_tags_fr,
            'product_size_en' => $request->product_size_en,
            'product_size_fr' => $request->product_size_fr,
            'product_color_en' => $request->product_color_en,
            'product_color_fr' => $request->product_color_fr,

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,

            'short_descp_en' => $request->short_descp_en,
            'short_descp_fr' => $request->short_descp_fr,

            'long_descp_en' => $request->long_descp_en,
            'long_descp_fr' => $request->long_descp_fr,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'status' => 1,
            'created_at' => Carbon::now(),   	 

            'product_thambnail' => $save_url,
        ]);

        $images = $request->file('multi_img');
        
        foreach($images as $multi_image){

            $image_gen = hexdec(uniqid()).'.'.$multi_image->getClientOriginalExtension();
        
            Image::make($multi_image)->resize(917,1000)->save('upload/products/multi-image/'.$image_gen);
        
            $save_urls = 'upload/products/multi-image/'.$image_gen;
            
            Multi_image::insert([
                'product_id' => $product_id,
                'photo' => $save_urls,
                'created_at'  => Carbon::now(),
            ]);
            
        }
        
        $notification = array(
            'message' => 'Product Added Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('all.product')->with($notification);
	}

    public function AllProduct(){
        $produit = Product::latest()->get();
        return view('backend.product.product_all',compact('produit'));
    }

    public function EditProduct($id){

        $products = Product::findOrFail($id);

		$categories = Categorie::latest()->get();
		$brands = Brand::latest()->get();

		//$subcategory = SubCategorie::latest()->get();
        $subcategory = SubCategorie::where('categorie_id',$products->categorie_id)->get();

        //$subsubcategory = SubSubCategorie::latest()->get();
		$subsubcategory = SubSubCategorie::where('sub_categorie_id',$products->sub_categorie_id)->get();
		
		return view('backend.product.product_edit',compact('categories','brands','subcategory','subsubcategory','products'));
	}

    public function UpdateProduct(Request $request){
        if($image = $request->file('product_thambnail')){

            @unlink(public_path(Product::findOrFail($request->id)->product_thambnail));
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(917,1000)->save('upload/products/thambnail/'.$name_gen);
            $save_url = 'upload/products/thambnail/'.$name_gen;

            Product::findOrFail($request->id)->update([
            
                'categorie_id' => $request->categorie_id,
                'sub_categorie_id' => $request->sub_categorie_id,
                'sub_sub_categorie_id' => $request->sub_sub_categorie_id,

                'brand_id' => $request->brand_id,
                'product_name_en' => $request->product_name_en,
                'product_name_fr' => $request->product_name_fr,
                'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
                'product_slug_fr' => strtolower(str_replace(' ', '-', $request->product_name_fr)),

                'product_tags_en' => $request->product_tags_en,
                'product_tags_fr' => $request->product_tags_fr,
                'product_size_en' => $request->product_size_en,
                'product_size_fr' => $request->product_size_fr,
                'product_color_en' => $request->product_color_en,
                'product_color_fr' => $request->product_color_fr,

                'product_code' => $request->product_code,
                'product_qty' => $request->product_qty,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,

                'short_descp_en' => $request->short_descp_en,
                'short_descp_fr' => $request->short_descp_fr,

                'long_descp_en' => $request->long_descp_en,
                'long_descp_fr' => $request->long_descp_fr,

                'hot_deals' => $request->hot_deals,
                'featured' => $request->featured,
                'special_offer' => $request->special_offer,
                'special_deals' => $request->special_deals,

                'status' => 1,
                'created_at' => Carbon::now(),   	 

                'product_thambnail' => $save_url,
            ]);
        }
        else{
            Product::findOrFail($request->id)->update([
      	
                'categorie_id' => $request->categorie_id,
                'sub_categorie_id' => $request->sub_categorie_id,
                'sub_sub_categorie_id' => $request->sub_sub_categorie_id,
    
                'brand_id' => $request->brand_id,
                'product_name_en' => $request->product_name_en,
                'product_name_fr' => $request->product_name_fr,
                'product_slug_en' => strtolower(str_replace(' ', '-', $request->product_name_en)),
                'product_slug_fr' => strtolower(str_replace(' ', '-', $request->product_name_fr)),
    
                'product_tags_en' => $request->product_tags_en,
                'product_tags_fr' => $request->product_tags_fr,
                'product_size_en' => $request->product_size_en,
                'product_size_fr' => $request->product_size_fr,
                'product_color_en' => $request->product_color_en,
                'product_color_fr' => $request->product_color_fr,
    
                'product_code' => $request->product_code,
                'product_qty' => $request->product_qty,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
    
                'short_descp_en' => $request->short_descp_en,
                'short_descp_fr' => $request->short_descp_fr,
    
                'long_descp_en' => $request->long_descp_en,
                'long_descp_fr' => $request->long_descp_fr,
    
                'hot_deals' => $request->hot_deals,
                'featured' => $request->featured,
                'special_offer' => $request->special_offer,
                'special_deals' => $request->special_deals,
    
                'status' => 1,
                'created_at' => Carbon::now(),
            ]);
        }
        $notification = array(
            'message' => 'Product Updated Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('all.product')->with($notification);
    }
}
