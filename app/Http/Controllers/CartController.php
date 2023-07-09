<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

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

	// Checkout Method 
    public function CheckoutCreate(){

        if (Auth::check()) {
            if (Cart::total() > 0) {
				$carts = Cart::content();
				$cartQty = Cart::count();
				$cartTotal = Cart::total();
				$divisions = ShipDivision::orderBy('division_name','ASC')->get();
        		return view('frontend.checkout.checkout_view',compact('carts','cartQty','cartTotal','divisions'));
            }else{
				$notification = array(
				'message' => 'Shopping At list One Product',
				'alert-type' => 'info'
				);
				return redirect()->to('/')->with($notification);
            }
        }else{
            $notification = array(
            'message' => 'You Need to Login First',
            'alert-type' => 'error'
        	);
        	return redirect()->route('login')->with($notification);
        }
    } // end method 
}
