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

	Route::group(array(
		'as' => 'list.',
		'prefix' => 'list'
	), function() {		
		Route::post('/create', 'BoardListController@create');
		Route::put('/edit/{listId}', 'BoardListController@edit');
		Route::delete('/delete/{listId}', 'BoardListController@delete');
	});

	Route::group(array(
		'as' => 'card.',
		'prefix' => 'card'
	), function() {		
		Route::post('/create', 'BoardCardController@create');
		Route::put('/edit/{listId}', 'BoardCardController@edit');
		Route::delete('/delete/{listId}', 'BoardCardController@delete');
	});

});