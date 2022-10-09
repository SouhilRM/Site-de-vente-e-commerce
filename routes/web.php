<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;



Route::get('/', function () {
    return view('welcome');
});

/* ca marche
Route::middleware('admin:admin')->group(function () {
    Route::get('admin/login', [AdminController::class, 'LoginForm']);
    Route::post('admin/login', [AdminController::class, 'store'])->name('admin.login');
});
*/


//mais ca c'est plus propre
Route::middleware(['admin:admin'])->prefix('/admin')->group(function () {

    Route::controller(AdminController::class)->group(function(){
        Route::get('/login','LoginForm');
        Route::post('/login','store')->name('admin.login');
    });
});



Route::middleware([
    
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified'

])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('dashboard');
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
