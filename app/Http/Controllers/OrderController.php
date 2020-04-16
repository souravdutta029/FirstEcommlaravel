<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;

class OrderController extends Controller
{
   public function manage_order()
   {

   		$get_order = DB::table('orders')
					  ->join('customer', 'orders.customer_id','=','customer.customer_id')
					  ->select('orders.*', 'customer.customer_name')
					  ->get();

		// echo "<pre>";
		// print_r($get_order);
		// echo "</pre>";
		// exit();
		$order_info = view('admin.manage-order')
					  ->with('all_order_info', $get_order);
		return view('admin_layout')
				->with('admin.manage-order', $order_info);

   } 



   public function view_order($order_id)
   {

   		$get_order_id = DB::table('orders')
					  ->join('customer', 'orders.customer_id','=','customer.customer_id')
					  ->join('order_details', 'orders.order_id','=','order_details.order_id')
					  ->join('shipping', 'orders.shipping_id','=','shipping.shipping_id')
					  ->select('orders.*','customer.*','order_details.*','shipping.*')	  
					  ->first();

		// echo "<pre>";
		// print_r($get_order_id);
		// echo "</pre>";
		// exit();
		$view_order = view('admin.view-order')
					  ->with('all_order_info', $get_order_id);
		return view('admin_layout')
				->with('admin.view-order', $view_order);

   }

}
