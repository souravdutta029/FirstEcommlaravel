<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class SuperAdminController extends Controller
{
    
	public function index(){

		$this->AdminAuthorization();
		return view('admin.dashboard');
	}


    
    public function logout(){

    	// Session::put('admin_name', null);
    	// Session::put('admin_id', null);
    	Session::flush();
    	return redirect('/admin');
    }


    public function AdminAuthorization(){

    	$admin_id = Session::get('admin_id');
    	if($admin_id){
    		return;
    	}else{
    		return Redirect::to('/admin')->send();
    	}
    }
}
