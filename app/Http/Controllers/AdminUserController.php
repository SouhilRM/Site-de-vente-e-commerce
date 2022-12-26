<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function AllAdminRole(){
    	$adminuser = Admin::where('type',2)->latest()->get();
    	return view('backend.role.admin_role_all',compact('adminuser'));
    } // end method 

    public function AddAdminRole(){
    	return view('backend.role.admin_role_create');
    }// end method 

    public function StoreAdminRole(Request $request){
	    Admin::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

            'phone' => $request->phone,
            'brand' => $request->brand,
            'category' => $request->category,
            'product' => $request->product,
            'slider' => $request->slider,
            'coupons' => $request->coupons,

            'shipping' => $request->shipping,
            //'blog' => $request->blog,
            'setting' => $request->setting,
            'returnorder' => $request->returnorder,
            'review' => $request->review,

            'orders' => $request->orders,
            'stock' => $request->stock,
            'reports' => $request->reports,
            'alluser' => $request->alluser,
            'adminuserrole' => $request->adminuserrole,

            'type' => 2,
            'created_at' => Carbon::now(),
    	]);
	    $notification = array(
            'message' => 'Admin User Created Successfully',
            'alert-type' => 'success'
		);
		return redirect()->route('all.admin.user')->with($notification);
    } // end method

    public function EditAdminRole($id){
    	$adminuser = Admin::findOrFail($id);
    	return view('backend.role.admin_role_edit',compact('adminuser'));
    } // end method 

    public function UpdateAdminRole(Request $request){
    	$admin_id = $request->id;
    	Admin::findOrFail($admin_id)->update([
        'name' => $request->name,
        'email' => $request->email,

        'phone' => $request->phone,
        'brand' => $request->brand,
        'category' => $request->category,
        'product' => $request->product,
        'slider' => $request->slider,
        'coupons' => $request->coupons,

        'shipping' => $request->shipping,
        //'blog' => $request->blog,
        'setting' => $request->setting,
        'returnorder' => $request->returnorder,
        'review' => $request->review,

        'orders' => $request->orders,
        'stock' => $request->stock,
        'reports' => $request->reports,
        'alluser' => $request->alluser,
        'adminuserrole' => $request->adminuserrole,
        'type' => 2,

        'created_at' => Carbon::now(),
    	]);
	    $notification = array(
        'message' => 'Admin User Updated Successfully',
        'alert-type' => 'info'
		  );
		  return redirect()->route('all.admin.user')->with($notification);
    } // end method 

    public function DeleteAdminRole($id){
      Admin::findOrFail($id)->delete();
      $notification = array(
        'message' => 'Admin User Deleted Successfully',
        'alert-type' => 'info'
      );
      return redirect()->back()->with($notification);
    } // end method 
}
