<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Frontend routes here =================================================================================
Route::get('/', 'HomeController@index');

// Front Page Routes ====================================================================================
Route::get('/product-by-category/{category_id}','HomeController@show_product_by_category' );
Route::get('/product-by-brand/{brand_id}','HomeController@show_product_by_brand' );
Route::get('/view-product/{product_id}','HomeController@view_product' );


// Cart Route =====================================================================================
Route::post('/add-to-cart', 'CartController@add_to_cart');
Route::get('/show-cart', 'CartController@show_cart');
Route::get('/delete-cart/{rowId}', 'CartController@delete_cart');
Route::post('/update-cart', 'CartController@update_cart');


// Checkout and Registration Routes =================================================================
Route::get('/login-check','CheckoutController@login_check');
Route::post('/customer-registration','CheckoutController@customer_registration');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-shipping-details','CheckoutController@save_shipping_details');
Route::post('/login-customer','CheckoutController@login_customer');
Route::get('/logout-customer', 'CheckoutController@logout_customer');
Route::get('/payment', 'CheckoutController@payment');
Route::post('/order-place','CheckoutController@order_place');







// Backend Routes Related to Admin.======================================================================
Route::get('/logout','SuperAdminController@logout');
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'SuperAdminController@index');
Route::post('/admin-dashboard', 'AdminController@dashboard');


// Category Related Routes=====================================================================================
Route::get('/add-category','CategoryController@index');
Route::get('/all-category','CategoryController@all_category');
Route::post('/save-category','CategoryController@save_category');
Route::get('/edit-category/{category_id}','CategoryController@edit_category');
Route::post('/update-category/{category_id}','CategoryController@update_category');
Route::get('/delete-category/{category_id}','CategoryController@delete_category');
Route::get('/inactive-category/{category_id}','CategoryController@inactive_category');
Route::get('/active-category/{category_id}','CategoryController@active_category');


// Brand Related  Routes  ================================================================================
Route::get('/add-brand','BrandController@index');
Route::get('/all-brand','BrandController@all_brand');
Route::post('/save-brand','BrandController@save_brand');
Route::get('/edit-brand/{brand_id}','BrandController@edit_brand');
Route::post('/update-brand/{brand_id}','BrandController@update_brand');
Route::get('/delete-brand/{brand_id}','BrandController@delete_brand');
Route::get('/inactive-brand/{brand_id}','BrandController@inactive_brand');
Route::get('/active-brand/{brand_id}','BrandController@active_brand');


// Product Related Routes ================================================================================
Route::get('/add-product', 'ProductController@index');
Route::get('/all-product', 'ProductController@all_product');
Route::post('/save-product','ProductController@save_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::get('/inactive-product/{product_id}','ProductController@inactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');


// Routes for Slider ======================================================================================
Route::get('/add-slider', 'SliderController@index');
Route::post('/save-slider', 'SliderController@save_slider');
Route::get('/all-slider', 'SliderController@all_slider');
Route::get('/delete-slider/{slider_id}','SliderController@delete_slider');
Route::get('/inactive-slider/{slider_id}','SliderController@inactive_slider');
Route::get('/active-slider/{slider_id}','SliderController@active_slider');


// Routes for Shop and Its Details========================================================================
Route::get('/add-shop', 'ShopController@index');
Route::post('/save-shop', 'ShopController@save_shop');
Route::get('/all-shop', 'ShopController@all_shop');
Route::get('/edit-shop/{shop_id}','ShopController@edit_shop');
Route::post('/update-shop/{shop_id}','ShopController@update_shop');
Route::get('/delete-shop/{shop_id}','ShopController@delete_shop');
Route::get('/inactive-shop/{shop_id}','ShopController@inactive_shop');
Route::get('/active-shop/{shop_id}','ShopController@active_shop');


// Backend Order related Routes
Route::get('/manage-order', 'OrderController@manage_order');
Route::get('/view-order/{order_id}', 'OrderController@view_order');