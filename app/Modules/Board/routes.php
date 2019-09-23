<?php

Route::group(array(
    'as' => 'board.',
    'prefix' => 'board',
    'namespace' => 'App\Modules\Board\Controllers',
    'middleware' => 'auth:api'
), function() {

	Route::get('/{boardId}', 'BoardController@get');
	Route::post('/create', 'BoardController@create');
	Route::put('/edit/{boardId}', 'BoardController@edit');
	Route::delete('/delete/{boardId}', 'BoardController@delete');

});