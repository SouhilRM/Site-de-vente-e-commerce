<?php

namespace App\Http\Controllers; //modiff

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Pipeline;
use App\Actions\Fortify\AttemptToAuthenticate;  //modiff
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable; //modiff
use App\Http\Responses\LoginResponse;    //modiff
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;

use App\Models\Admin;

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
        $admin = Admin::findOrFail('1');
        return view('admin.admin_profile',compact('admin'));
    }

    public function AdminProfileEdit(){
        $admin = Admin::findOrFail('1');
        return view('admin.admin_profile_edit',compact('admin'));
    }

    public function AdminProfileStore(Request $request){

        $data = Admin::findOrFail('1');
        
        $data->name = $request->name;
        $data->email = $request->email;

        $image = $request->file('profile_photo_path');

        if($image){
            $del_image = Admin::findOrFail('1')->profile_photo_path;
            
            //unlink('upload/profile_image/'.$del_image);
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
}
