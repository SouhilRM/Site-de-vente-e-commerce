<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;

class CartPageController extends Controller
{
    public function MyCart(){
    	return view('frontend.wishlist.view_mycart');
    }//end method 

    public function GetCartProduct(){
        $carts = Cart::content();
    	$cartQty = Cart::count();
    	$cartTotal = Cart::total();

    	return response()->json(array(
    		'carts' => $carts,
    		'cartQty' => $cartQty,
    		'cartTotal' => $cartTotal,

    	));
    }//end method 

    public function RemoveCartProduct($rowId){
        Cart::remove($rowId);

        //cette partie concerne le coupon
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        
        return response()->json(['success' => 'Successfully Remove From Cart']);
    }//end method 

    public function CartIncrement($rowId){
        //la méthode "get" et "update" sont implementer de base avec le package bumbummen go check la doc
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);


        //cette partie concerne le coupon
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

           Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100), 
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)  
            ]);
        }
        //cette partie concerne le coupon


        return response()->json('increment');
    } // end mehtod

    public function CartDecrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);
        return response()->json('Decrement');
    }// end mehtod
}
