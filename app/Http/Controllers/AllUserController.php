<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Order;
use App\Models\OrderItem;

class AllUserController extends Controller
{
    public function MyOrders(){
    	$orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->get();
    	return view('frontend.user.order.order_view',compact('orders'));
    }// end mehtod 

    public function OrderDetails($order_id){
    	$order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();    
    	$orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
    	return view('frontend.user.order.order_details',compact('order','orderItem'));
    } // end mehtod 
}
