<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class BrandController extends Controller
{
    public function index(){

        $this->AdminAuthorization();
    	return view('admin.add-brand');
    }


    public function all_brand(){

        $this->AdminAuthorization();
    	$get_brand_info = DB::table('tbl_brand')->get();
		$manage_brand = view('admin.all-brand')
						 ->with('all_brand_info', $get_brand_info);

		return view('admin_layout')
				->with('admin.all-brand', $manage_brand);
    	

    	// return view('admin.all-category');
    }


    public function save_brand(Request $request){

    	$data = array();
    	$data['brand_id'] = $request->brand_id;
    	$data['brand_name'] = $request->brand_name;
    	$data['brand_description'] = $request->brand_description;
    	$data['publication_status'] = $request->publication_status;    

    	DB::table('tbl_brand')->insert($data);
    	Session::put('message','Brand added successfully.');
    	return redirect('/add-brand');
    }


    public function inactive_brand($brand_id){

    	DB::table('tbl_brand')
    		->where('brand_id', $brand_id)
    		->update(['publication_status'=> 0]);
    		Session::put('message','Brand Inactivated successfully.');
    		return redirect('/all-brand');
    }


    public function active_brand($brand_id){

    	DB::table('tbl_brand')
    		->where('brand_id', $brand_id)
    		->update(['publication_status'=> 1]);
    		Session::put('message','Brand Activated successfully.');
    		return redirect('/all-brand');
    }


    public function delete_brand($brand_id){

    	DB::table('tbl_brand')
    		->where('brand_id', $brand_id)
    		->delete();

    	Session::put('message', 'Brand Deleted.');
    	return redirect('/all-brand');
    }


    public function edit_brand($brand_id){

        $this->AdminAuthorization();
    	$get_brand = DB::table('tbl_brand')
    			   ->where('brand_id', $brand_id)
    			   ->first();

    	$brand_info = view('admin.edit-brand') 
    				->with('all_brand_info', $get_brand);

    	return view('admin_layout')
    			->with('admin.edit-brand', $brand_info);
    }



    public function update_brand(Request $request, $brand_id){

    	$data = array();
    	$data['brand_name'] = $request->brand_name;
    	$data['brand_description'] = $request->brand_description;

    	DB::table('tbl_brand')
    		->where('brand_id', $brand_id)
    		->update($data);

    	Session::put('message', 'Brand Updated successfully.');
    	return redirect('/all-brand');
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
