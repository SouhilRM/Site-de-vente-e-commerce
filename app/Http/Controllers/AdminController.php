<?php

namespace App\Http\Controllers; //modiff

use App\Models\Admin;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Features;
use Illuminate\Routing\Pipeline;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\StatefulGuard;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Laravel\Fortify\Contracts\LoginViewResponse;
use App\Http\Responses\LoginResponse;    //modiff
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use App\Actions\Fortify\AttemptToAuthenticate;  //modiff
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable; //modiff

class AdminController extends Controller //modiff
{

    protected $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function LoginForm(){
        return view('auth.admin_login',['guard' => 'admin']);
    }
    
    public function create(Request $request): LoginViewResponse
    {
        return app(LoginViewResponse::class);
    }

    public function store(LoginRequest $request)
    {
        return $this->loginPipeline($request)->then(function ($request) {
            return app(LoginResponse::class);
        });
    }
   
    protected function loginPipeline(LoginRequest $request)
    {
        if (Fortify::$authenticateThroughCallback) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                call_user_func(Fortify::$authenticateThroughCallback, $request)
            ));
        }

        if (is_array(config('fortify.pipelines.login'))) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                config('fortify.pipelines.login')
            ));
        }

        return (new Pipeline(app()))->send($request)->through(array_filter([
            config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
            Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]));
    }

    public function destroy(Request $request): LogoutResponse
    {
        $this->guard->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return app(LogoutResponse::class);
    }

    public function AdminProfile(){
        $admin = Admin::findOrFail(Auth::id());
        return view('admin.admin_profile',compact('admin'));
    }

    public function AdminProfileEdit(){
        $admin = Admin::findOrFail(Auth::id());
        return view('admin.admin_profile_edit',compact('admin'));
    }

    public function AdminProfileStore(Request $request){

        $data = Admin::findOrFail(Auth::id());
        
        
        $data->name = $request->name;
        $data->email = $request->email;

        $image = $request->file('profile_photo_path');

        if($image){
            $del_image = $data->profile_photo_path;
            
            //unlink('upload/profile_image/'.$del_image);   marche aussu kifkif
            @unlink(public_path('upload/profile_image/'.$del_image));
            

            $filename = date('YmdHi').$image->getClientOriginalName();

            $image->move(public_path('upload/profile_image'),$filename);

            $data['profile_photo_path'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Profile Updated Successfuly', 
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function AdminChangePassword(){
        
        return view('admin.change_password');
    }

    public function AdminUpdatePassword(Request $request){

        $validateData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirmation_password' => 'required|same:new_password',   //et tu colles bien tout sinon ca te fais de jolies erreurs
        ]);

        //$hashedPassword = Auth::user()->password;     //ca marche aussi
        $hashedPassword = Admin::findOrFail(Auth::id())->password;
        
        if(Hash::check($request->old_password,$hashedPassword)){

            $admin = Admin::findOrFail(Auth::id());

            //$admin->password = bcrypt($request->new_password);    //ca marche aussi
            $admin->password = Hash::make($request->new_password);

            $admin->save();

            //Auth::logout();   //pas la peine jetstream le fait automatiquement

            return redirect()->route('admin_dashboard');
        }
        else{
            return redirect()->back();
        }
        
    }
}
