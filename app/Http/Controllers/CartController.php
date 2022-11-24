<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id){
        
		//cette partie concerne le coupon
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        
		
    	$product = Product::findOrFail($id);

    	if ($product->discount_price == NULL){
    		Cart::add([
    			'id' => $id, 
    			'name' => $request->product_name, 
    			'qty' => $request->quantity, 
    			'price' => $product->selling_price,
    			'weight' => 1, 
    			'options' => [
    				'image' => $product->product_thambnail,
    				'color' => $request->color,
    				'size' => $request->size,
    			],
    		]);

    		return response()->json(['success' => 'Successfully Added on Your Cart']);

    	}
        else{
    		Cart::add([
    			'id' => $id, 
    			'name' => $request->product_name, 
    			'qty' => $request->quantity, 
    			'price' => $product->discount_price,
    			'weight' => 1,
    			'options' => [
    				'image' => $product->product_thambnail,
    				'color' => $request->color,
    				'size' => $request->size,
    			],
    		]);
    		return response()->json(['success' => 'Successfully Added on Your Cart']);
    	}

    } // end mehtod

    public function AddMiniCart(){

    	$carts = Cart::content();
    	$cartQty = Cart::count();
    	$cartTotal = Cart::total();

    	return response()->json(array(
    		'carts' => $carts,
    		'cartQty' => $cartQty,
    		'cartTotal' => $cartTotal,
    	));
    } // end method

    public function RemoveMiniCart($rowId){
    	Cart::remove($rowId);
    	return response()->json(['success' => 'Product Remove from Cart']);

    } // end mehtod

	public function CouponApply(Request $request){
		$coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        if ($coupon) {
			Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round((int)Cart::total() * $coupon->coupon_discount/100), 
                'total_amount' => round((int)Cart::total() - (int)Cart::total() * $coupon->coupon_discount/100)
			]);
			return response()->json(array('success' => 'Coupon Applied Successfully'));
		}
		else 
			return response()->json(['error' => 'Invalid Coupon']);
    }// end mehtod

	public function CouponCalculation(){

        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total(),
            ));

        }
    } // end method 

	public function CouponRemove(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    }// end method 
}
