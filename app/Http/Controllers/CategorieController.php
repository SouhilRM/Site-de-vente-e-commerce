<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class CategorieController extends Controller
{
    public function AllCategorie(){
        $category = Categorie::latest()->get();
        return view('backend.category.category_all',compact('category'));
    }

    public function StoreCategorie(Request $request){
        $request->validate([
            'categorie_name_en' => 'required',
            'categorie_name_fr' => 'required',
            'categorie_icone' => 'required',
        ],[
            'categorie_name_en.required' => 'The category name is required',
            'categorie_name_fr.required' => 'The category name is required',
            'categorie_icone.required' => 'The category icon required',
        ]);

        Categorie::insert([
            'categorie_name_en' => $request->categorie_name_en,
            'categorie_name_fr' => $request->categorie_name_fr,
            'categorie_slug_en' => strtolower(str_replace(' ','-',$request->categorie_name_en)),
            'categorie_slug_fr' => strtolower(str_replace(' ','-',$request->categorie_name_fr)),
            'categorie_icone' => $request->categorie_icone,
        ]);

        $notification = array(
            'message' => 'Category added successfuly', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditCategorie($id){
        $category = Categorie::findOrFail($id);
        return view('backend.category.category_edit',compact('category'));
    }

    public function UpdateCategorie(Request $request){
        $request->validate([
            'categorie_name_en' => 'required',
            'categorie_name_fr' => 'required',
            'categorie_icone' => 'required',
        ],[
            'categorie_name_en.required' => 'The category name is required',
            'categorie_name_fr.required' => 'The category name is required',
            'categorie_icone.required' => 'The category icon required',
        ]);
        Categorie::findOrFail($request->id)->update([
            'categorie_name_en' => $request->categorie_name_en,
            'categorie_name_fr' => $request->categorie_name_fr,
            'categorie_slug_en' => strtolower(str_replace(' ','-',$request->categorie_name_en)),
            'categorie_slug_fr' => strtolower(str_replace(' ','-',$request->categorie_name_fr)),
            'categorie_icone' => $request->categorie_icone,
        ]);
        $notification = array(
            'message' => 'Category updated successfuly', 
            'alert-type' => 'success'
        );
        return redirect()->route('all.categorie')->with($notification);
    }

    public function DeleteCategorie($id){
        $category = Categorie::findOrFail($id);
        $category->delete();
        $notification = array(
            'message' => 'Category deleted successfuly', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
