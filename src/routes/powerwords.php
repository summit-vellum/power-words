<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the ArticleServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'web'], function() {

	Route::group(['prefix' => 'power-words'], function () {
		Route::post('/check-usage', '\Quill\PowerWords\Http\Controllers\PowerWordsController@checkUsage');
		Route::post('/validate-word', '\Quill\PowerWords\Http\Controllers\PowerWordsController@validateWord');
	});

});
