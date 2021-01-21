<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    //
});

//,'middleware' =>'app_version'
$api->version(['v1'],['namespace' => 'App\Http\Controllers\Api'],  function ($api)
{
    //Login Users With an Email ,Password and sucure apitoken which we provide directly
    $api->post('login','Auth\AuthenticationController@login');
    //Register Users With an Email ,Password and assign role dynamically
    $api->post('register','Auth\RegisterController@register');

    //Get Poll Lists with its Options
    $api->get('get-polls','Polls\MyPollsController@getPolls');

    $api->post('update-user-polls-vote','Polls\MyPollsController@updateUserVote');
});

$api->version(['v1'],['namespace' => 'App\Http\Controllers\Api','middleware' => 'client_credentials','app_version'],  function ($api)
{
  //Update User Profile Details
    $api->post('update/profile','User\UserController@updateProfile');   
});

