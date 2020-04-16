<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();

class HomeController extends Controller
{
    public function index(){
    	
    	$all_published_products = DB::table('tbl_products')
    				->join('tbl_category', 'tbl_products.category_id','=','tbl_category.category_id')
    				->join('tbl_brand', 'tbl_products.brand_id','=','tbl_brand.brand_id')
    				->select('tbl_products.*','tbl_category.category_name', 'tbl_brand.brand_name')
    				->where('tbl_products.publication_status', 1)
    				->limit(9)
    				->get();

    	$product_details = view('pages.home')
    					->with('all_product_details', $all_published_products);

    	return view('layout')
    		  ->with('pages.home', $product_details);

    }


    public function show_product_by_category($category_id){

        $get_product_by_category = DB::table('tbl_products')
                    ->join('tbl_category', 'tbl_products.category_id','=','tbl_category.category_id')
                    ->select('tbl_products.*','tbl_category.category_name')
                    ->where('tbl_products.category_id', $category_id)
                    ->where('tbl_products.publication_status', 1)
                    ->limit(18)
                    ->get();


        $manage_product_by_category = view('pages.product-by-category')
                                    ->with('get_all_product', $get_product_by_category);

        return view('layout')
            ->with('pages.product-by-category', $manage_product_by_category);
    }



    public function show_product_by_brand($brand_id){

        $get_product_by_brand = DB::table('tbl_products')
                    ->join('tbl_brand', 'tbl_products.brand_id','=','tbl_brand.brand_id')
                    ->select('tbl_products.*','tbl_brand.brand_name')
                    ->where('tbl_products.brand_id', $brand_id)
                    ->where('tbl_products.publication_status', 1)
                    ->limit(18)
                    ->get();


        $manage_product_by_brand = view('pages.product-by-brand')
                                    ->with('get_brand_product', $get_product_by_brand);

        return view('layout')
            ->with('pages.product-by-brand', $manage_product_by_brand);
    }


    public function view_product($product_id){

        $get_product_by_id = DB::table('tbl_products')
                    ->join('tbl_brand', 'tbl_products.brand_id','=','tbl_brand.brand_id')
                    ->join('tbl_category', 'tbl_products.category_id','=','tbl_category.category_id')
                    ->select('tbl_products.*','tbl_brand.brand_name', 'tbl_category.category_name')
                    ->where('tbl_products.product_id', $product_id)
                    ->where('tbl_products.publication_status', 1)
                    ->limit(18)
                    ->first();


        $manage_product_by_id = view('pages.view-product')
                                    ->with('get_product_view', $get_product_by_id);

        return view('layout')
            ->with('pages.view-product', $manage_product_by_id);
    }

}
