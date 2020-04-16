<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class ShopController extends Controller
{
    public function index(){

    	return view('admin.add-shop');
    }


    public function all_shop(){

    	$shop_details = DB::table('shopname')->get();
    	$shop_info = view('admin.all-shop')
    			   ->with('all_shop_info', $shop_details);

    	return view('admin_layout')
    			->with('admin.all-shop', $shop_info);
    }


    public function save_shop(Request $request){

    	$data = array();
    	$data['shop_title'] = $request->shop_title;
    	$data['shop_tagline'] = $request->shop_tagline;
    	$data['shop_description'] = $request->shop_description;
    	$data['publication_status'] = $request->publication_status;

    	DB::table('shopname')->insert($data);
    	Session::put('message', 'Shop Details Saved Successfully.');
    	return Redirect::to('/add-shop');
    }


    public function inactive_shop($shop_id){

    	DB::table('shopname')
    		->where('shop_id', $shop_id)
    		->update(['publication_status'=> 0]);
    		Session::put('message','Shop Inactivated successfully.');
    		return redirect('/all-shop');
    } 


    public function active_shop($shop_id){

    	DB::table('shopname')
    		->where('shop_id', $shop_id)
    		->update(['publication_status'=> 1]);
    		Session::put('message','Shop Aactivated successfully.');
    		return redirect('/all-shop');
    } 


    public function delete_brand($brand_id){

    	DB::table('shopname')
    		->where('shop_id', $shop_id)
    		->delete();

    	Session::put('message', 'Shop Deleted.');
    	return redirect('/all-shop');
    }



    public function edit_shop($shop_id){

    	$get_shop = DB::table('shopname')
    			   ->where('shop_id', $shop_id)
    			   ->first();

    	$shop_info = view('admin.edit-shop') 
    				->with('all_shop_info', $get_shop);

    	return view('admin_layout')
    			->with('admin.edit-shop', $shop_info);
    }



    public function update_shop(Request $request, $shop_id){

    	$data = array();
    	$data['shop_title'] = $request->shop_title;
    	$data['shop_tagline'] = $request->shop_tagline;
    	$data['shop_description'] = $request->shop_description;

    	DB::table('shopname')
    		->where('shop_id', $shop_id)
    		->update($data);

    	Session::put('message', 'Shop Details Updated successfully.');
    	return redirect('/all-shop');
    }
}
