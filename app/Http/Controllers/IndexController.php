<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Slider;
use App\Models\Product;

class IndexController extends Controller
{
    public function Index(){
        $categories = Categorie::orderBy('categorie_name_en','ASC')->get();
        $slider = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $products = Product::where('status',1)->orderBy('id','DESC')->limit(10)->get();
        $featured = Product::where('status',1)->where('featured',1)->orderBy('id','DESC')->limit(8)->get();
        $hot_deals = Product::where('status',1)->where('hot_deals',1)->orderBy('id','DESC')->limit(5)->get();
        $special_offer = Product::where('status',1)->where('special_offer',1)->orderBy('id','DESC')->limit(9)->get();
        $special_deals = Product::where('status',1)->where('special_deals',1)->orderBy('id','DESC')->limit(9)->get();
        return view('frontend.index',compact('categories','slider','products','featured','hot_deals','special_offer','special_deals'));
    }

    public function UserLogout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function UserProfile(){
        $id = Auth::user()->id;     //$id = Auth::id();  ---> ca marche tres bien aussi
        $user = User::findOrFail($id);
        return view('frontend.profile.user_profile',compact('user'));
    }

    public function UserProfileStore(Request $request){
        $data = User::findOrFail(Auth::user()->id);
        
        
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        $image = $request->file('profile_photo_path');

        if($image){
            $del_image = $data->profile_photo_path;
            
            //unlink('upload/user_image/'.$del_image);
            @unlink(public_path('upload/user_image/'.$del_image));
            

            $filename = date('YmdHi').$image->getClientOriginalName();

            $image->move(public_path('upload/user_image'),$filename);

            $data['profile_photo_path'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Profile Updated Successfuly', 
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);
    }

    public function UserChangePassword(){
        return view('frontend.profile.user_changepassword');
    }

    public function UserUpdatePassword(Request $request){

        $validateData = $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword',   //et tu colles bien tout sinon ca te fais de jolies erreurs
        ]);

        //$hashedPassword = Auth::user()->password;     //ca marche aussi
        $hashedPassword = User::findOrFail(Auth::id())->password;
        
        if(Hash::check($request->oldPassword,$hashedPassword)){

            $user = User::findOrFail(Auth::id());

            //$admin->password = bcrypt($request->new_password);    //ca marche aussi
            $user->password = Hash::make($request->newPassword);

            $user->save();

            //Auth::logout();   //pas la peine jetstream le fait automatiquement

            return redirect()->route('dashboard');
        }
        else{
            $notification = array(
                'message' => 'Wrong Password !!', 
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function ProductDetails($slug_en,$id){
        $product = Product::findOrFail($id);
        return view('frontend.product.product_details',compact('product'));
    }
}
