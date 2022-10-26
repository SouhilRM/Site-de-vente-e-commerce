<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\SubCategorie;
use App\Models\Categorie;
use App\Models\SubSubCategorie;

class SubSubCategorieController extends Controller
{
    public function AllSubSubCategorie(){
        $categorie = Categorie::orderBy('categorie_name_en','ASC')->get();
        $subcategory = SubCategorie::orderBy('categorie_name_en','ASC')->get();
        $subsubcategory = SubSubCategorie::latest()->get();
        return view('backend.sub_sub_category.sub_sub_category_all',compact('subcategory','categorie','subsubcategory'));
    }

    public function GetSubCategory($category_id){

        $subcat = SubCategorie::where('categorie_id',$category_id)->orderBy('categorie_name_en','ASC')->get();
        return json_encode($subcat);
    }

    public function StoreSubSubCategorie(Request $request){
        $request->validate([
            'categorie_name_en' => 'required',
            'categorie_name_fr' => 'required',
            'categorie_id' => [
                'required',
                Rule::notIn(['Select One Category']),//n'oublie pas d'ajouter en haut --> use Illuminate\Validation\Rule;
            ],
            'sub_categorie_id' => 'required',
        ],[
            'categorie_name_en.required' => 'The subcategory name is required',
            'categorie_name_fr.required' => 'The subcategory name is required',
            'categorie_id' => 'The category is required',
            'sub_categorie_id' => 'The sub-category is required',
        ]);

        SubSubCategorie::insert([
            'categorie_name_en' => $request->categorie_name_en,
            'categorie_name_fr' => $request->categorie_name_fr,
            'categorie_slug_en' => strtolower(str_replace(' ','-',$request->categorie_name_en)),
            'categorie_slug_fr' => strtolower(str_replace(' ','-',$request->categorie_name_fr)),
            'categorie_id' => $request->categorie_id,
            'sub_categorie_id' => $request->sub_categorie_id,
        ]);

        $notification = array(
            'message' => 'SubSubCategory added successfuly', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditSubSubCategorie($id){
        $categorie = Categorie::orderBy('categorie_name_en','ASC')->get();
        
        $subsubcategory = SubSubCategorie::findOrFail($id);

        $catid = $subsubcategory->categorie_id;
        $subcatrgiries = SubCategorie::where('categorie_id',$catid)->orderBy('categorie_name_en','ASC')->get();

        
        return view('backend.sub_sub_category.sub_sub_category_edit',compact('categorie','subsubcategory','subcatrgiries'));
    }

    public function UpdateSubSubCategorie(Request $request){
        $request->validate([
            'categorie_name_en' => 'required',
            'categorie_name_fr' => 'required',
            'categorie_id' => [
                'required',
                Rule::notIn(['Select One Category']),//n'oublie pas d'ajouter en haut --> use Illuminate\Validation\Rule;
            ],
        ],[
            'categorie_name_en.required' => 'The subcategory name is required',
            'categorie_name_fr.required' => 'The subcategory name is required',
            'categorie_id' => 'The category is required',
            
        ]);
        SubSubCategorie::findOrFail($request->id)->update([
            'categorie_name_en' => $request->categorie_name_en,
            'categorie_name_fr' => $request->categorie_name_fr,
            'categorie_slug_en' => strtolower(str_replace(' ','-',$request->categorie_name_en)),
            'categorie_slug_fr' => strtolower(str_replace(' ','-',$request->categorie_name_fr)),
            'categorie_id' => $request->categorie_id,
            'sub_categorie_id' => $request->sub_categorie_id,
        ]);
        $notification = array(
            'message' => 'Sub-Sub-Category updated successfuly', 
            'alert-type' => 'success'
        );
        return redirect()->route('all.sub.sub.categorie')->with($notification);
    }

    public function DeleteSubSubCategorie($id){
        $category = SubSubCategorie::findOrFail($id);
        $category->delete();
        $notification = array(
            'message' => 'SubSubCategorie deleted successfuly', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
