<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;


/* ========================================ADMIN======================================== */
Route::middleware([
    
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified'

])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('admin_dashboard')->middleware('auth:admin');

});
Route::controller(AdminController::class)->prefix('/admin')->group(function(){
    Route::middleware(['admin:admin'])->group(function(){
        Route::get('/login','LoginForm');
        Route::post('/login','store')->name('admin.login');
        
    });
    Route::middleware(['auth:sanctum,admin',config('jetstream.auth_session'),'verified'])->group(function(){
        Route::get('/logout','destroy')->name('admin.logout')->middleware('auth:admin');
        Route::get('/profile','AdminProfile')->name('admin.profile')->middleware('auth:admin');
        Route::get('/profile/edit','AdminProfileEdit')->name('admin.profile.edit')->middleware('auth:admin');
        Route::post('/profile/store','AdminProfileStore')->name('admin.profile.store')->middleware('auth:admin');
        Route::get('/change/password','AdminChangePassword')->name('admin.change.password')->middleware('auth:admin');
        Route::post('/update/password','AdminUpdatePassword')->name('admin.update.password')->middleware('auth:admin');
    });
});
/* ========================================/ADMIN======================================== */


/* ========================================USER======================================== */
Route::middleware([
    
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'

])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});
Route::controller(IndexController::class)->group(function(){
    Route::get('/','Index')->name('home');
    
});
/* ========================================/USER======================================== */
