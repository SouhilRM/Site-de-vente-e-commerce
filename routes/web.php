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
    Route::get('/logout','destroy')->name('admin.logout');

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
