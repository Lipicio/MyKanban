<?php

Route::group(array(
    'as' => 'users.',
    'prefix' => 'users',
    'namespace' => 'App\Modules\User\Controllers',
), function() {

	Route::post('login', 'UserController@login');
	Route::post('register', 'UserController@register');
	Route::group(['middleware' => 'auth:api'], function()
	{
	   Route::post('details', 'UserController@details');
	});

});