<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class IndexController extends Controller
{
    public function Index(){
        return view('frontend.index');
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
}
