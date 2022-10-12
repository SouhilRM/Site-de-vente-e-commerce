<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;



Route::get('/', function () {
    return view('welcome');
});


Route::controller(AdminController::class)->prefix('/admin')->group(function(){
    Route::middleware(['admin:admin'])->group(function(){
        Route::get('/login','LoginForm');
        Route::post('/login','store')->name('admin.login');
        
    });
    Route::middleware(['auth:sanctum,admin',config('jetstream.auth_session'),'verified'])->group(function(){
        Route::get('/logout','destroy')->name('admin.logout');
        Route::get('/profile','AdminProfile')->name('admin.profile');
        Route::get('/profile/edit','AdminProfileEdit')->name('admin.profile.edit');
        Route::post('/profile/store','AdminProfileStore')->name('admin.profile.store');
    });
});




Route::middleware([
    
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified'

])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard')->middleware('auth:admin');

});



Route::middleware([
    
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'

])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});
