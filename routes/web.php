<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\SubCategorieController;
use App\Http\Controllers\SubSubCategorieController;
use App\Http\Controllers\ProductController;

/* =======================================ADMIN======================================== */
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

        /*Route::middleware(['auth:sanctum,admin',config('jetstream.auth_session'),'verified'])->group(function(){*/
        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/logout','destroy')->name('admin.logout')->middleware('auth:admin');
            Route::get('/profile','AdminProfile')->name('admin.profile')->middleware('auth:admin');
            Route::get('/profile/edit','AdminProfileEdit')->name('admin.profile.edit')->middleware('auth:admin');
            Route::post('/profile/store','AdminProfileStore')->name('admin.profile.store')->middleware('auth:admin');
            Route::get('/change/password','AdminChangePassword')->name('admin.change.password')->middleware('auth:admin');
            Route::post('/update/password','AdminUpdatePassword')->name('admin.update.password')->middleware('auth:admin');
        });
    });
/* ======================================/ADMIN======================================== */

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

        Route::middleware(['auth'])->group(function () {
            Route::get('/user/logout','UserLogout')->name('user.logout');
            Route::get('/user/profile','UserProfile')->name('user.profile');
            Route::post('/user/profile/store','UserProfileStore')->name('user.profile.store');
            Route::get('/user/change/password','UserChangePassword')->name('user.change.password');
            Route::post('/user/update/password','UserUpdatePassword')->name('user.update.password');
        });
    });
/* ========================================/USER======================================= */

/* ========================================BRAND======================================= */
    Route::controller(BrandController::class)->prefix('/brand')->group(function(){

        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/all','AllBrand')->name('all.brand');
            Route::post('/store','StoreBrand')->name('store.brand');
            Route::get('/edit/{id}','EditBrand')->name('edit.brand');
            Route::post('/update','UpdateBrand')->name('update.brand');
            Route::get('/delete/{id}','DeleteBrand')->name('delete.brand');
        }); 
    });
/* ========================================/BRAND======================================= */

/* =====================================CATEGORIE======================================= */
    Route::controller(CategorieController::class)->prefix('/categorie')->group(function(){

        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/all','AllCategorie')->name('all.categorie');
            Route::post('/store','StoreCategorie')->name('store.categorie');
            Route::get('/edit/{id}','EditCategorie')->name('edit.categorie');
            Route::post('/update','UpdateCategorie')->name('update.categorie');
            Route::get('/delete/{id}','DeleteCategorie')->name('delete.categorie');
        }); 
    });
/* =====================================/CATEGORIE======================================= */

/* ===============================SUB-CATEGORIE================================= */
    Route::controller(SubCategorieController::class)->prefix('/categorie')->group(function(){
        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/sub/all','AllSubCategorie')->name('all.sub.categorie');
            Route::post('/sub/store','StoreSubCategorie')->name('store.sub.categorie');
            Route::get('/sub/edit/{id}','EditSubCategorie')->name('edit.sub.categorie');
            Route::post('/sub/update','UpdateSubCategorie')->name('update.sub.categorie');
            Route::get('/sub/delete/{id}','DeleteSubCategorie')->name('delete.sub.categorie');
        }); 
    });
/* ================================/SUB-CATEGORIE=============================== */

/* ===============================SUB-CATEGORIE================================= */
    Route::controller(SubSubCategorieController::class)->prefix('/categorie')->group(function(){
        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/sub/sub/all','AllSubSubCategorie')->name('all.sub.sub.categorie');
            Route::get('/subcategorie/ajax/{categorie_id}','GetSubCategory');
            Route::post('/sub/sub/store','StoreSubSubCategorie')->name('store.sub.sub.categorie');
            Route::get('/sub/sub/edit/{id}','EditSubSubCategorie')->name('edit.sub.sub.categorie');
            Route::post('/sub/sub/update','UpdateSubSubCategorie')->name('update.sub.sub.categorie');
            Route::get('/sub/sub/delete/{id}','DeleteSubSubCategorie')->name('delete.sub.sub.categorie');
        }); 
    });
/* ================================/SUB-CATEGORIE=============================== */

/* =======================================PRODUCT======================================= */
    Route::controller(ProductController::class)->prefix('/product')->group(function(){

        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/all','AllProduct')->name('all.product');
            Route::get('/add','AddProduct')->name('add.product');
            Route::get('/subcategorie/ajax/{categorie_id}','GetSubCategory');
            Route::get('/subsubcategorie/ajax/{sub_categorie_id}','GetSubSubCategory');
            Route::post('/store','StoreProduct')->name('store.product');
            Route::get('/edit/{id}','EditProduct')->name('edit.product');
            Route::post('/update','UpdateProduct')->name('update.product');
            Route::post('/update/images','UpdateImages')->name('update.product.images');
            Route::get('/delete/images/{id}','DeleteProductImages')->name('delete.product.images');
            Route::get('/delete/{id}','DeleteProduct')->name('delete.product');
            Route::get('/inactive/{id}','InActiveProduct')->name('inactive.product');
            Route::get('/active/{id}','ActiveProduct')->name('active.product');
        }); 
    });
/* =======================================/PRODUCT======================================= */
