<?php

Route::group(['prefix' => 'blog'], function () {
    Route::get('/', function () {
        dd('This is the Blog module index page. Build something great!');
    });
});

Route::group(['prefix' => 'blog/admin'], function () {
    Route::get('/', function () {
        dd('This is the Blog module index page. Build something great!');
    });

    Route::get('/post', 'PostController@index');
    Route::get('/post-index-ajax', 'PostController@indexAjax');
    Route::get('/post-form', 'PostController@form');
    Route::put('/post-edit', 'PostController@edit');
    Route::post('/post-save', 'PostController@save');
    Route::delete('/post-delete', 'PostController@delete');

});
