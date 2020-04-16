<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class CategoryController extends Controller
{
    public function index(){

        $this->AdminAuthorization();
    	return view('admin.add-category');
    }

    public function all_category(){

        $this->AdminAuthorization();
		$all_category_info = DB::table('tbl_category')->get();
		$manage_category = view('admin.all-category')
						 ->with('all_category_info', $all_category_info);

		return view('admin_layout')
				->with('admin.all-category', $manage_category);
    	

    	// return view('admin.all-category');
    }

    public function save_category(Request $request){

    	$data = array();
    	$data['category_id'] = $request->category_id;
    	$data['category_name'] = $request->category_name;
    	$data['category_description'] = $request->category_description;
    	$data['publication_status'] = $request->publication_status;    

    	DB::table('tbl_category')->insert($data);
    	Session::put('message','Category added successfully.');
    	return redirect('/add-category');

    }


    public function inactive_category($category_id){

    	DB::table('tbl_category')
    		->where('category_id', $category_id)
    		->update(['publication_status'=> 0]);
    		Session::put('message','Category Inactivated successfully.');
    		return redirect('/all-category');
    }

    public function active_category($category_id){

    	DB::table('tbl_category')
    		->where('category_id', $category_id)
    		->update(['publication_status'=> 1]);
    		Session::put('message','Category activated successfully.');
    		return redirect('/all-category');
    }


    public function edit_category($category_id){

        $this->AdminAuthorization();
    	$get_category = DB::table('tbl_category')
    		->where('category_id', $category_id)
    		->first();

    	$category_info = view('admin.edit-category')
						 ->with('all_category_info', $get_category); 

		return view('admin_layout')
				->with('admin.edit-category', $category_info);
    	// return view ('admin.edit-category');
    }



    public function update_category(Request $request, $category_id){

    	$data = array();
    	$data['category_name'] = $request->category_name;
    	$data['category_description'] = $request->category_description;

    	DB::table('tbl_category')
    		->where('category_id', $category_id)
    		->update($data);

    	Session::put('message', "Category updated successfully.");
    	return redirect('/all-category');
    }



    public function delete_category($category_id){

    	DB::table('tbl_category')
    		->where('category_id', $category_id)
    		->delete();

    	Session::put('message', "Category deleted.");
    	return redirect('/all-category');
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
