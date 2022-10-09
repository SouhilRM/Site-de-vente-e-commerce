<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

use App\Http\Controllers\AdminController;                   //ajout
use App\Actions\Fortify\AttemptToAuthenticate;              //ajout
use App\Actions\Fortify\RedirectIfTwoFactorAuthenticatable; //ajout
use Illuminate\Contracts\Auth\StatefulGuard;                //ajout
use Auth;                                                   //ajout


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when([

            AdminController::class,                     //le controller
            AttemptToAuthenticate::class,               //la classe AttemptToAuthenticate
            RedirectIfTwoFactorAuthenticatable::class,  //la classe RedirectIfTwoFactorAuthenticatable

        ])->needs(StatefulGuard::class)->give(function(){

            return Auth::guard('admin');                //le guard qu'on a creer
        });

        //n'oublie pas d'ajouter tout ca en haut
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
