<?php

Route::group(array(
    'as' => 'board.',
    'prefix' => 'board',
    'namespace' => 'App\Modules\Board\Controllers',
    'middleware' => 'auth:api'
), function() {

	Route::post('/create', 'BoardController@createOrEdit');
	Route::put('/edit', 'BoardController@createOrEdit');
	Route::delete('/delete/{boardId}', 'BoardController@delete');

});