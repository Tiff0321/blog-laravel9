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

//首页
Route::get('/', 'StaticPagesController@home')->name('home');
//帮助页面
Route::get('help', 'StaticPagesController@help')->name('help');
//关于页面
Route::get('about', 'StaticPagesController@about')->name('about');
//用户资源路由
Route::resource('users', 'UserController');
//注册页面
Route::get('signup', 'UserController@create')->name('signup');
//登录页面
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
// 退出登录
Route::delete('logout', 'SessionsController@destroy')->name('logout');
//激活用户账户
Route::get('signup/confirm/{token}', 'UserController@confirmEmail')->name('confirm_email');
//密码重置
Route::get('password/reset', 'PasswordsController@showLinkRequestForm')->name('passwords.request');
Route::post('password/email', 'PasswordsController@sendResetLinkEmail')->name('passwords.email');
//密码更新页面，显示更新密码的表单，包含token
Route::get('password/reset/{token}', 'PasswordsController@showResetForm')->name('passwords.reset');
Route::post('password/reset', 'PasswordsController@reset')->name('passwords.update');
