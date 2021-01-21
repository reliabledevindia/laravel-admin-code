<?php

/*
|--------------------------------------------------------------------------
| Web Routes For Admin
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix('admin')->group( function() {
	Route::middleware(['web','auth'])->group(function () {
		Route::resource('polls', 'PollsController')->except([
		   'show'
		]);
    });
});

/*
|--------------------------------------------------------------------------
| Web Routes For Frontend User
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
		'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth']
	], 
function()
{
	Route::post('user/vote-for-polls', 'Frontend\MyPollsController@voteForPoll')->name('user.voteForPoll');
});