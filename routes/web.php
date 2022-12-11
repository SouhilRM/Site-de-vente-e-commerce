<?php

//controllers
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\IndexController;
    use App\Http\Controllers\BrandController;
    use App\Http\Controllers\CategorieController;
    use App\Http\Controllers\SubCategorieController;
    use App\Http\Controllers\SubSubCategorieController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\SliderController;
    use App\Http\Controllers\LanguageController;
    use App\Http\Controllers\CartController;
    use App\Http\Controllers\WishlistController;
    use App\Http\Controllers\CartPageController;
    use App\Http\Controllers\CouponController;
    use App\Http\Controllers\ShippingAreaController;
    use App\Http\Controllers\CheckoutController;
    use App\Http\Controllers\StripeController;
    use App\Http\Controllers\AllUserController;
    use App\Http\Controllers\CashController;
    use App\Http\Controllers\OrderController;
    use App\Http\Controllers\ReportController;
    use App\Http\Controllers\AdminProfileController;
    use App\Http\Controllers\SiteSettingController;
    use App\Http\Controllers\ReturnController;
    use App\Http\Controllers\ReviewController;
//end-controllers

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
    /*
    Route::middleware([
        
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified'

    ])->group(function () {

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

    });
    */

    //le dashboard qu'on a mis hors controller 
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard')->middleware(['user']);

    Route::controller(IndexController::class)->group(function(){

        Route::get('/','Index')->name('home');

        Route::middleware(['user'])->group(function () {
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

/* =====================================SLIDER======================================= */
    Route::controller(SliderController::class)->prefix('/slider')->group(function(){

        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/all','AllSlider')->name('all.slider');
            Route::post('/store','StoreSlider')->name('store.slider');
            Route::get('/edit/{id}','EditSlider')->name('edit.slider');
            Route::post('/update','UpdateSlider')->name('update.slider');
            Route::get('/delete/{id}','DeleteSlider')->name('delete.slider');
            Route::get('/inactive/{id}','InActiveSlider')->name('inactive.slider');
            Route::get('/active/{id}','ActiveSlider')->name('active.slider');
        }); 
    });
/* =====================================/SLIDER======================================= */

/* ========================================LANGUE======================================= */
    Route::controller(LanguageController::class)->group(function(){
        Route::get('/language/english','English')->name('english.languange');
        Route::get('/language/french','French')->name('french.languange');
    });
/* ========================================/LANGUE======================================= */

/* ========================================TAG======================================= */
    Route::controller(IndexController::class)->group(function(){

        Route::get('/product/details/{id}/{slug_en}','ProductDetails')->name('product.details');
        Route::get('/product/tag/{tag}','ProductTag')->name('product.tag');
        Route::get('/product/subcat/{id}/{slug_en}','ProductSubcat')->name('product.subcat');
        Route::get('/product/subsubcat/{id}/{slug_en}','ProductSubSubcat')->name('product.subsubcat');
        Route::get('/product/view/modal/{id}','ProductViewAjax'); ////url:"{{ route('product.view.modal') }}" + '/' + id,   marche aussi !!
    });
/* =======================================/TAG======================================= */

/* ==================================MINI-CART===================================== */
    Route::controller(CartController::class)->group(function(){

        Route::post('/cart/data/store/{id}','AddToCart');
        Route::get('/product/mini/cart','AddMiniCart');
        Route::get('/minicart/product-remove/{rowId}','RemoveMiniCart');
        Route::post('/add-to-wishlist/{product_id}','AddToWishlist');
    });
/* ==================================/MINI-CART===================================== */

/* =====================================WISHLIST======================================= */
    Route::controller(WishlistController::class)->group(function(){
        Route::post('/add-to-wishlist/{product_id}','AddToWishlist');
        Route::middleware(['user'])->group(function () {
            Route::get('/wishlist','ViewWishlist')->name('wishlist');
            Route::get('/get-wishlist-product','GetWishlistProduct');
            Route::get('/wishlist-remove/{id}','RemoveWishlistProduct');
        });
    });
/* =====================================/WISHLIST======================================= */

/* =====================================MYCART======================================= */
    Route::controller(CartPageController::class)->group(function(){
        //pas de middlware pour ca
        Route::get('/mycart','MyCart')->name('mycart');
        Route::get('/get-cart-product','GetCartProduct');
        Route::get('/cart-remove/{rowId}','RemoveCartProduct');
        Route::get('/cart-increment/{rowId}','CartIncrement');
        Route::get('/cart-decrement/{rowId}','CartDecrement');
    });
/* =====================================/MYCART======================================= */

/* =====================================COUPON======================================= */
    Route::controller(CouponController::class)->prefix('/coupon')->group(function(){

        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/view','CouponView')->name('manage-coupon');
            Route::post('/store','CouponStore')->name('coupon.store');
            Route::get('/edit/{id}','CouponEdit')->name('coupon.edit');
            Route::post('/update/{id}','CouponUpdate')->name('coupon.update');
            Route::get('/delete/{id}','CouponDelete')->name('coupon.delete');
        }); 
    });
/* =====================================/COUPON======================================= */

/* ==================================ShippingArea=================================== */
    Route::controller(ShippingAreaController::class)->prefix('/shipping')->group(function(){
        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/division/view','DivisionView')->name('manage-division');
            Route::post('/division/store','DivisionStore')->name('division.store');
            Route::get('/division/edit/{id}','DivisionEdit')->name('division.edit');
            Route::post('/division/update/{id}','DivisionUpdate')->name('division.update');
            Route::get('/division/delete/{id}','DivisionDelete')->name('division.delete');

            Route::get('/district/view','DistrictView')->name('manage-district');
            Route::post('/district/store','DistrictStore')->name('district.store');
            Route::get('/district/edit/{id}','DistrictEdit')->name('district.edit');
            Route::post('/district/update/{id}','DistrictUpdate')->name('district.update');
            Route::get('/district/delete/{id}','DistrictDelete')->name('district.delete');

            Route::get('/state/view','StateView')->name('manage-state');
            Route::post('/state/store','StateStore')->name('state.store');
            Route::get('/state/edit/{id}','StateEdit')->name('state.edit');
            Route::post('/state/update/{id}','StateUpdate')->name('state.update');
            Route::get('/state/delete/{id}','StateDelete')->name('state.delete');
            Route::get('/district/ajax/{division_id}','GetDistrict');

            }); 
    });
/* ==================================/ShippingArea=================================== */

/* ==================================FRONT-END COUPON================================= */
    Route::controller(CartController::class)->group(function(){

        Route::post('/coupon-apply','CouponApply');
        Route::get('/coupon-calculation','CouponCalculation');
        Route::get('/coupon-remove','CouponRemove');
    });
/* ==================================/FRONT-END COUPON================================= */

/* ==================================Checkout================================= */
    Route::controller(CartController::class)->group(function(){

        Route::get('/checkout','CheckoutCreate')->name('checkout');
        
    });

    Route::controller(CheckoutController::class)->group(function(){

        Route::get('/district-get/ajax/{division_id}','DistrictGetAjax');
        Route::get('/state-get/ajax/{district_id}','StateGetAjax');
        Route::post('/checkout/store','CheckoutStore')->name('checkout.store');


    });
/* ==================================/Checkout================================= */

/* ==================================STRIPE-PAYMENT=============================== */
    Route::controller(StripeController::class)->group(function(){

        Route::middleware(['auth'])->group(function () {
            Route::post('/stripe/order','StripeOrder')->name('stripe.order');
        });
    });
/* ==================================/STRIPE-PAYMENT=============================== */

/* ========================================ALLUsers==================================== */
    Route::controller(AllUserController::class)->prefix('/user')->group(function(){

        Route::middleware(['auth'])->group(function () {
            Route::get('/my/orders','MyOrders')->name('my.orders');
            Route::get('/order_details/{order_id}','OrderDetails');
            Route::get('/invoice_download/{order_id}','InvoiceDownload');
            Route::post('/return/order/{order_id}','ReturnOrder')->name('return.order');
            Route::get('/return/order/list','ReturnOrderList')->name('return.order.list');
            Route::get('/cancel/orders','CancelOrders')->name('cancel.orders');
        }); 
    });
/* ========================================/ALLUsers==================================== */

//CASH-ROUTE
Route::post('/cash/order', [CashController::class, 'CashOrder'])->name('cash.order');

/* =====================================ORDERS===================================== */
    Route::controller(OrderController::class)->prefix('/orders')->group(function(){

        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/pending/orders','PendingOrders')->name('pending-orders');
            Route::get('/pending/orders/details/{order_id}','PendingOrdersDetails')->name('pending.order.details');

            Route::get('/confirmed/orders','ConfirmedOrders')->name('confirmed-orders');
            Route::get('/processing/orders','ProcessingOrders')->name('processing-orders');
            Route::get('/picked/orders','PickedOrders')->name('picked-orders');
            Route::get('/shipped/orders','ShippedOrders')->name('shipped-orders');
            Route::get('/delivered/orders','DeliveredOrders')->name('delivered-orders');
            Route::get('/cancel/orders','CancelOrders')->name('cancel-orders');
        
            // Update Order Status
            Route::get('status/update/{id}/{status}','updateStatus')->name('order.updateStatus');

            Route::get('/invoice/download/{order_id}','AdminInvoiceDownload')->name('invoice.download');
        }); 
    });
/* =====================================/ORDERS===================================== */

/* ========================================REPORT===================================== */
    Route::controller(ReportController::class)->prefix('/reports')->group(function(){
        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/view','ReportView')->name('all-reports');
            Route::post('/search/by/date','ReportByDate')->name('search-by-date');
            Route::post('/search/by/month','ReportByMonth')->name('search-by-month');
            Route::post('/search/by/year','ReportByYear')->name('search-by-year');
        }); 
    });
/* ========================================/REPORT===================================== */

/* ================================GESTION-USER-back===================================== */
    Route::controller(AdminProfileController::class)->prefix('/alluser')->group(function(){

        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/view','AllUsers')->name('all-users');
        }); 
    });
/* ===============================/GESTION-USER-back===================================== */

/* ===================================OPTION-du-SITE===================================== */
    Route::controller(SiteSettingController::class)->prefix('/brand')->group(function(){
        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/site','SiteSetting')->name('site.setting');
            Route::post('/site/update','SiteSettingUpdate')->name('update.sitesetting');

            Route::get('/seo','SeoSetting')->name('seo.setting');
            Route::post('/seo/update','SeoSettingUpdate')->name('update.seosetting');
        }); 
    });
/* ===================================/OPTION-du-SITE===================================== */

/* ====================================RETURN-ORDER===================================== */
    Route::controller(ReturnController::class)->prefix('/return')->group(function(){
        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/admin/request','ReturnRequest')->name('return.request');
            Route::get('/admin/return/approve/{order_id}','ReturnRequestApprove')->name('return.approve');
            Route::get('/admin/all/request','ReturnAllRequest')->name('all.request');
        }); 
    });
/* ====================================/RETURN-ORDER===================================== */

/* ====================================REVIEW===================================== */
    Route::controller(ReviewController::class)->prefix('/review')->group(function(){
        Route::middleware(['user'])->group(function () {
            Route::post('/store','ReviewStore')->name('review.store');
        });  
        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/pending','PendingReview')->name('pending.review');
            Route::get('/admin/approve/{id}','ReviewApprove')->name('review.approve');
            Route::get('/publish','PublishReview')->name('publish.review');
            Route::get('/delete/{id}','DeleteReview')->name('delete.review');   
        });   
    });
/* ====================================/REVIEW===================================== */


