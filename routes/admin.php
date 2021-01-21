<?php

Route::group(['middleware' => ['guest']], function () {
    Route::get('admin/login', 'Auth\AdminLoginController@getAdminLogin')->name('admin.login');
    Route::post('admin/login', ['as' => 'admin.auth', 'uses' => 'Auth\AdminLoginController@adminAuth']);

});
//admin route for our multi-auth system
Route::prefix('admin')->group(function () {
    //admin password reset routes
    Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});
?>