<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//
//    return view('welcome');
//});



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => ['web']], function () {
    Route::get('login','home\LoginController@login');
    Route::get('register','home\RegisterController@register');
    Route::any('sendCode','home\ValidateController@sendSMS');
    Route::get('imgCode','home\ValidateController@imgCode'); //邮箱验证码
    Route::post('toRegister','home\RegisterController@toRegister');
    Route::any('validateEmail','home\ValidateController@validateEmail');//验证邮箱
    Route::any('toLogin','home\LoginController@toLogin');
    Route::get('index','home\IndexController@index');
    Route::get('all_cate','home\CategoryController@Cate');
    Route::get('cate/p_id/{p_id}','home\CategoryController@getCate');
    Route::get('product_list/cate_id/{cate_id}','home\ProductController@getProduct');
    Route::get('product_content/p_id/{p_id}','home\ProductController@getContent');
    Route::get('addCar/p_id/{p_id}','home\CarController@addCar');
    Route::get('carinfo','home\CarController@Car_info');
    Route::get('delcar','home\CarController@delCar');
});

Route::group(['middleware' => ['web','login.check']], function () {
    Route::get('orderCar/pro_ids/{pro_ids}','home\OrderController@OrderCar');
    Route::get('orders','home\OrderController@findOrder');
});
Route::group(['middleware' => ['web']], function () {

    Route::get('admin/login', 'admin\IndexController@login');
    Route::post('admin/toLogin', 'admin\LoginController@toLogin');
});
Route::group(['middleware' => ['web']], function () {

    Route::get('admin/index', 'admin\IndexController@index');
    Route::get('admin/category', 'admin\CategoryController@category');
    Route::get('admin/add_cate', 'admin\CategoryController@add_cate');
    Route::post('admin/add_cateinfo', 'admin\CategoryController@add_cateinfo');
    Route::get('admin/delCate/cate_id/{cate_id}','admin\CategoryController@delCate');
    Route::get('admin/editCate/cate_id/{cate_id}','admin\CategoryController@editCate');
    Route::post('admin/editCateinfo','admin\CategoryController@editCateinfo');
});