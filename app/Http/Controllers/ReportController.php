<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\Models\Order;

class ReportController extends Controller
{
    public function ReportView(){
        return view('backend.report.report_view');
    }//end methode

    public function ReportByDate(Request $request){
        // return $request->all(); tu remarques que le format est yyyy-mm-dd de type string et c'est pas ce qu'on veux car situ vas matte la BDD de orders la order_date est sous format dd-MOUNTH-yyyy donc tu changes garce à DateTime();
        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');
        //return gettype($formatDate) ;
        // return $formatDate;
        $orders = Order::where('order_date',$formatDate)->latest()->get();
        return view('backend.report.report_show',compact('orders'));
    } // end mehtod 

    public function ReportByMonth(Request $request){
        $orders = Order::where('order_month',$request->month)->where('order_year',$request->year_name)->latest()->get();
        return view('backend.report.report_show',compact('orders'));
    } // end mehtod 

    public function ReportByYear(Request $request){
        $orders = Order::where('order_year',$request->year)->latest()->get();
        return view('backend.report.report_show',compact('orders'));
    } // end mehtod 
}
