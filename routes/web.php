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
Route::group(
[
	'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function(){
	Route::get('/', function () {
	    return view('welcome');
	});
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');