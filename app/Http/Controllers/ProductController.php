<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategorie;
use App\Models\Categorie;
use App\Models\Brand;
use App\Models\Product;
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
}
