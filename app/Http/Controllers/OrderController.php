<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
	// Pending Orders 
	public function PendingOrders(){
		$orders = Order::where('status','pending')->orderBy('id','DESC')->get();
		return view('backend.orders.pending_orders',compact('orders'));
	} // end mehtod 

    // Pending Order Details 
	public function PendingOrdersDetails($order_id){
		$order = Order::with('division','district','state','user')->where('id',$order_id)->first();
    	$orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
    	return view('backend.orders.pending_orders_details',compact('order','orderItem'));
	} // end method 

    // Confirmed Orders 
	public function ConfirmedOrders(){
		$orders = Order::where('status','confirmed')->orderBy('id','DESC')->get();
		return view('backend.orders.confirmed_orders',compact('orders'));
	} // end mehtod 

	// Processing Orders 
	public function ProcessingOrders(){
		$orders = Order::where('status','processing')->orderBy('id','DESC')->get();
		return view('backend.orders.processing_orders',compact('orders'));
	} // end mehtod 

	// Picked Orders 
	public function PickedOrders(){
		$orders = Order::where('status','picked')->orderBy('id','DESC')->get();
		return view('backend.orders.picked_orders',compact('orders'));
	} // end mehtod 

	// Shipped Orders 
	public function ShippedOrders(){
		$orders = Order::where('status','shipped')->orderBy('id','DESC')->get();
		return view('backend.orders.shipped_orders',compact('orders'));
	} // end mehtod 

	// Delivered Orders 
	public function DeliveredOrders(){
		$orders = Order::where('status','delivered')->orderBy('id','DESC')->get();
		return view('backend.orders.delivered_orders',compact('orders'));
	} // end mehtod 

	// Cancel Orders 
	public function CancelOrders(){
		$orders = Order::where('status','cancel')->orderBy('id','DESC')->get();
		return view('backend.orders.cancel_orders',compact('orders'));
	} // end mehtod 

    /**
     * Update Order status pending to confirmed
     */
    public function updateStatus($id, $status)
    {
        # get order
        $order = Order::findOrFail($id);
 
		# update quantity whene product delivered
		if($status == "delivered"){
			$product = OrderItem::where('order_id',$id)->get();
			foreach ($product as $item) {
				Product::where('id',$item->product_id)
						->update(['product_qty' => DB::raw('product_qty-'.$item->qty)]);
			} 
		}

		# update status
        $order->update(["status" => $status]);
 
        # notification
        $notification = ['message' => "Order $status", "alert-type" => "success"];
 
        # redirect to next page
        return redirect()->route($status."-orders")->with($notification);
    }

    public function AdminInvoiceDownload($order_id){

		$order = Order::with('division','district','state','user')->where('id',$order_id)->first();
    	$orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

		$pdf = Pdf::loadView('backend.orders.order_invoice',compact('order','orderItem'))->setPaper('a4')->setOptions([
				'tempDir' => public_path(),
				'chroot' => public_path(),
		]);
		return $pdf->stream();

	} // end method 

}