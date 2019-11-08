<?php

Route::get('/links/{hash}', 'LinksController@byHash')->middleware('auth:api');
Route::post('/links', 'LinksController@create')->middleware('auth:api');
