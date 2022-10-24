<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\SubCategorie;
use App\Models\Categorie;

class SubCategorieController extends Controller
{
    public function AllSubCategorie(){
        $category = Categorie::orderBy('categorie_name_en','ASC')->get();
        $subcategory = SubCategorie::latest()->get();
        return view('backend.sub_category.sub_category_all',compact('subcategory','category'));
    }

    public function StoreSubCategorie(Request $request){
        $request->validate([
            'categorie_name_en' => 'required',
            'categorie_name_fr' => 'required',
            'category' => [
                'required',
                Rule::notIn(['Select One Category']),//n'oublie pas d'ajouter en haut --> use Illuminate\Validation\Rule;
            ],
        ],[
            'categorie_name_en.required' => 'The subcategory name is required',
            'categorie_name_fr.required' => 'The subcategory name is required',
            'category' => 'The category is required',
            
        ]);

        SubCategorie::insert([
            'categorie_name_en' => $request->categorie_name_en,
            'categorie_name_fr' => $request->categorie_name_fr,
            'categorie_slug_en' => strtolower(str_replace(' ','-',$request->categorie_name_en)),
            'categorie_slug_fr' => strtolower(str_replace(' ','-',$request->categorie_name_fr)),
            'categorie_id' => $request->category,
        ]);

        $notification = array(
            'message' => 'SubCategory added successfuly', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditSubCategorie($id){
        $category = Categorie::orderBy('categorie_name_en','ASC')->get();
        $subcategory = SubCategorie::findOrFail($id);
        return view('backend.sub_category.sub_category_edit',compact('subcategory','category'));
    }

    public function UpdateSubCategorie(Request $request){
        $request->validate([
            'categorie_name_en' => 'required',
            'categorie_name_fr' => 'required',
            'category' => [
                'required',
                Rule::notIn(['Select One Category']),//n'oublie pas d'ajouter en haut --> use Illuminate\Validation\Rule;
            ],
        ],[
            'categorie_name_en.required' => 'The subcategory name is required',
            'categorie_name_fr.required' => 'The subcategory name is required',
            'category' => 'The category is required',
            
        ]);
        SubCategorie::findOrFail($request->id)->update([
            'categorie_name_en' => $request->categorie_name_en,
            'categorie_name_fr' => $request->categorie_name_fr,
            'categorie_slug_en' => strtolower(str_replace(' ','-',$request->categorie_name_en)),
            'categorie_slug_fr' => strtolower(str_replace(' ','-',$request->categorie_name_fr)),
            'categorie_id' => $request->category,
        ]);
        $notification = array(
            'message' => 'SubCategory updated successfuly', 
            'alert-type' => 'success'
        );
        return redirect()->route('all.sub.categorie')->with($notification);
    }

    public function DeleteSubCategorie($id){
        $category = SubCategorie::findOrFail($id);
        $category->delete();
        $notification = array(
            'message' => 'SubCategorie deleted successfuly', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
