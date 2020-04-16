<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class ProductController extends Controller{

	public function index(){

		$this->AdminAuthorization();
		return view('admin.add-product');
	}


	

	public function all_product(){

		$this->AdminAuthorization();
		$get_products = DB::table('tbl_products')
					  ->join('tbl_category', 'tbl_products.category_id','=','tbl_category.category_id')
					  ->join('tbl_brand', 'tbl_products.brand_id','=','tbl_brand.brand_id')
					  ->select('tbl_products.*', 'tbl_category.category_name', 'tbl_brand.brand_name')
					  ->get();

		// echo "<pre>";
		// print_r($get_products);
		// echo "</pre>";
		// exit();
		$product_info = view('admin.all-product')
					  ->with('all_product_info', $get_products);
		return view('admin_layout')
				->with('admin.all-product', $product_info);
	}


	

	public function save_product(Request $request){

		$data = array();
		$data['product_name'] = $request->product_name;
		$data['category_id'] = $request->category_id;
		$data['brand_id'] = $request->brand_id;
		$data['product_short_description'] = $request->product_short_description;
		$data['product_long_description'] = $request->product_long_description;
		$data['product_price'] = $request->product_price;
		$data['product_size'] = $request->product_size;
		$data['product_color'] = $request->product_color;
		$data['publication_status'] = $request->publication_status;

		// Drama for images continues
		$image = $request->file('product_image');
		if($image){

			$image_name = Str::random(20);
			$ext = strtolower($image->getClientOriginalExtension());
			$image_full_name = $image_name.'.'.$ext;
			$upload_path = 'images/';
			$image_url = $upload_path.$image_full_name;
			$success = $image->move($upload_path, $image_full_name);
			if($success){
				$data['product_image'] = $image_url;

				DB::table('tbl_products')->insert($data);
				Session::put('message','Product Added Successfully.');
				return redirect('/add-product');
			}

		}
		$data['product_image'] = '';

		DB::table('tbl_products')->insert($data);
		Session::put('message','Product Added Successfully without Image.');
		return redirect('/add-product');
	}



	public function inactive_product($product_id){

		DB::table('tbl_products')
			->where('product_id', $product_id)
			->update(['publication_status'=> 0]);

			Session::put('message', 'Product Inactivated.');
			return redirect('/all-product');
	}



	public function active_product($product_id){

		DB::table('tbl_products')
			->where('product_id', $product_id)
			->update(['publication_status'=> 1]);

			Session::put('message', 'Product Activated.');
			return redirect('/all-product');
	}



	public function delete_product($product_id){

		DB::table('tbl_products')
			->where('product_id', $product_id)
			->delete();

		Session::put('message', 'Product Deleted Successfully.');
		return redirect('/all-product');
	}



	public function edit_product($product_id){

		$this->AdminAuthorization();
		$product_get = DB::table('tbl_products')
					  ->where('product_id', $product_id)
					  ->first();
		$product_manage = view('admin.edit-product')
						->with('product_info', $product_get);

		return view('admin_layout')
			   ->with('admin.edit-product', $product_manage);
		
	}


// Authentication Function
	public function AdminAuthorization(){

    	$admin_id = Session::get('admin_id');
    	if($admin_id){
    		return;
    	}else{
    		return Redirect::to('/admin')->send();
    	}
    }


}

