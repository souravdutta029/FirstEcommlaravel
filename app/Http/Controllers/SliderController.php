<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class SliderController extends Controller
{
    public function index(){

    	$this->AdminAuthorization();
    	return view('admin.add-slider');
    }


    public function save_slider(Request $request){

    	$data = array();
    	$data['publication_status'] = $request->publication_status;

		// Drama for images continues
		$image = $request->file('slider_image');
		if($image){

			$image_name = Str::random(20);
			$ext = strtolower($image->getClientOriginalExtension());
			$image_full_name = $image_name.'.'.$ext;
			$upload_path = 'slider_img/';
			$image_url = $upload_path.$image_full_name;
			$success = $image->move($upload_path, $image_full_name);
			if($success){
				$data['slider_image'] = $image_url;

				DB::table('slider')->insert($data);
				Session::put('message','Image Added Successfully.');
				return Redirect::to('/add-slider');
			}

		}
		$data['slider_image'] = '';

		// DB::table('tbl_products')->insert($data);
		Session::put('message','Image field cant be empty.');
		return Redirect::to('/add-slider');
	}


	public function all_slider(){

		$this->AdminAuthorization();
		$get_slider = DB::table('slider')->get();
		$slider_info = view('admin.all-slider')
					->with('all_slider_info', $get_slider);

		return view('admin_layout')
			   ->with('admin.all-slider', $slider_info);
	}


	public function inactive_slider($slider_id){

		DB::table('slider')
			->where('slider_id', $slider_id)
			->update(['publication_status' => 0]);
		Session::put('message','Slider Image Inactivated Succesfully');
		return Redirect::to('/all-slider');
	}


	public function active_slider($slider_id){

		DB::table('slider')
			->where('slider_id', $slider_id)
			->update(['publication_status' => 1]);
		Session::put('message','Slider Image Activated Succesfully');
		return Redirect::to('/all-slider');
	}


	public function delete_slider($slider_id){

		DB::table('slider')
			->where('slider_id', $slider_id)
			->delete();

		Session::put('message','Slider Image Deleted Succesfully');
		return Redirect::to('/all-slider');
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
