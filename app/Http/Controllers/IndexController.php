<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;

class IndexController extends Controller
{

    //user methodes
        public function UserLogout(){
            Auth::logout();
            return redirect()->route('login');
        }//end methode

        public function UserProfile(){
            $id = Auth::user()->id;     //$id = Auth::id();  ---> ca marche tres bien aussi
            $user = User::findOrFail($id);
            return view('frontend.profile.user_profile',compact('user'));
        }//end methode

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
        }//end methode

        public function UserChangePassword(){
            return view('frontend.profile.user_changepassword');
        }//end methode

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
        }//end methode
    //user methodes : END


    public function Index(){

        $categories = Categorie::orderBy('categorie_name_en','ASC')->get();
        $slider = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $products = Product::where('status',1)->orderBy('id','DESC')->limit(10)->get();

        $featured = Product::where('status',1)->where('featured',1)->orderBy('id','DESC')->limit(8)->get();
        $hot_deals = Product::where('status',1)->where('hot_deals',1)->whereNot('discount_price',NULL)->orderBy('id','DESC')->limit(5)->get();
        $special_offer = Product::where('status',1)->where('special_offer',1)->orderBy('id','DESC')->limit(9)->get();
        $special_deals = Product::where('status',1)->where('special_deals',1)->orderBy('id','DESC')->limit(9)->get();
        $brands = Brand::orderBy('brand_name_en','ASC')->get();

        return view('frontend.index',compact('categories','slider','products','featured','hot_deals','special_offer','special_deals','brands'));
    }//end methode

    public function ProductDetails($slug_en,$id){
        $product = Product::findOrFail($id);
        $hot_deals = Product::where('status',1)->where('hot_deals',1)->whereNot('discount_price',NULL)->orderBy('id','DESC')->limit(5)->get();
        return view('frontend.product.product_details',compact('product','hot_deals'));
    }//end methode

    public function productTag($tag)
    {
        $products = Product::where('status', 1)->where('product_tags_en', 'LIKE', '%' . $tag . '%')->orWhere('product_tags_fr', 'LIKE', '%' . $tag . '%')->orderBy('id', 'DESC')->paginate(3);

        $categories = Categorie::orderBy('categorie_name_en','ASC')->get();

        $tag = $tag;
        return view('frontend.product.product_tag',compact('products','categories','tag'));
    }//end methode
}
