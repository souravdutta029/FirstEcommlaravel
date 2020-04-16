<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Cart;
use Session;
session_start();

class CheckoutController extends Controller
{
    public function login_check(){

    	return view('pages.login');
    }

    public function customer_registration(Request $request){

    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	$data['customer_email'] = $request->customer_email;
    	$data['password'] = md5($request->password);
    	$data['mobile_number'] = $request->mobile_number;

    	$customer_id = DB::table('customer')
    				->insertGetId($data);

    	Session::put('customer_id', $customer_id);
    	Session::put('customer_name', $request->customer_name);
    	return Redirect::to('/checkout');


    }


    public function checkout(){

    	return view('pages.checkout');

    }


    public function save_shipping_details(Request $request){

    	$data = array();
    	$data['shipping_email']      = $request->shipping_email;
    	$data['shipping_first_name'] = $request->shipping_first_name;
    	$data['shipping_last_name']  = $request->shipping_last_name;
    	$data['shipping_address']    = $request->shipping_address;
    	$data['shipping_mobile']     = $request->shipping_mobile;
    	$data['shipping_city']       = $request->shipping_city;
    	$data['shipping_state']      = $request->shipping_state;

    	$shipping_id = DB::table('shipping')
    					->insertGetId($data);
    	Session::put('shipping_id', $shipping_id);
    	return Redirect::to('/payment');

	}


    public function payment(){

        return view('pages.payment');

    }


	public function login_customer(Request $request){

		$customer_email = $request->customer_email;
		$password = md5($request->password);
		$result = DB::table('customer')
				->where('customer_email', $customer_email)
				->where('password', $password)
				->first();

		if($result){
			Session::put('customer_name', $result->customer_name);
			Session::put('customer_id', $result->customer_id);

			$cart = Cart::content()->isEmpty();
			if($cart){
				return redirect('/');
			}else{
				return redirect('/checkout');
			}			
		}else{

           return redirect('/login-check'); 
        }
	}


    
    public function order_place(Request $request){

        // payments table
        $payment_gateway = $request->payment_gateway;
        
        $pay_data = array();
        $pay_data['payment_method'] = $request->payment_gateway;
        $pay_data['payment_status'] = 'pending';

        $payment_id = DB::table('payments')
                ->insertGetId($pay_data);

        
        // orders table
        $orders_data = array();
        $orders_data['customer_id'] = Session::get('customer_id');
        $orders_data['shipping_id'] = Session::get('shipping_id');  
        $orders_data['payment_id'] = $payment_id;
        $orders_data['order_total'] = Cart::total();
        $orders_data['order_status'] = 'pending';

        $order_id = DB::table('orders')
                        ->insertGetId($orders_data);
              
        // order_details
        $content = Cart::content();
        $order_details_data = array();

        foreach($content as $v_content){

            $order_details_data['order_id'] = $order_id;
            $order_details_data['product_id'] = $v_content->id;
            $order_details_data['product_name'] = $v_content->name;
            $order_details_data['product_price'] = $v_content->price;
            $order_details_data['product_sales_quantity'] = $v_content->qty;

            DB::table('order_details')
                ->insert($order_details_data);

        }

        if($payment_gateway == 'cash on delivery'){

            Cart::destroy();
            return view('pages.cod');

        }elseif($payment_gateway == 'debit cards'){
            echo "Debit Cards.";
        }elseif($payment_gateway == 'paytm'){
            echo "Paytm.";
        }else{
            echo "None Selected.";
        }
    }


	

    public function logout_customer(){

		Session::flush();
    	return redirect('/');
	}




}


