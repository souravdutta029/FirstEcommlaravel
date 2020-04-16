<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
session_start();

class AdminController extends Controller
{
    public function index(){
    	return view('admin_login');
    }

    // public function show_dashboard(){
    // 	return view('admin.dashboard');
    // }  
    // moved this function to SuperAdminController for Authorization.

    public function dashboard(Request $request){
    	$admin_email = $request->admin_email;
    	$admin_password = md5($request->admin_password);
    	$result = DB::table('tbl_admin')
    			  -> where('admin_email', $admin_email)
    			  -> where('admin_password', $admin_password)	
    			  -> first();
    		if($result){
    			// make the session
    			Session::put('admin_name', $result->admin_name);
    			Session::put('admin_id', $result->admin_id);
    			return redirect('/dashboard');
    		}else{
    			Session::put('message','Email or Password is Invalid.');
    			return redirect('/admin');
    		}
    }
}
