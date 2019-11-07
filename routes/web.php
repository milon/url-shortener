<?php

Auth::routes();

Route::get('/', 'LinksController@create');
Route::post('/links', 'LinksController@store');
Route::get('/links/{link}', 'LinksController@show');
Route::get('/dashboard', 'DashboardController@index')->middleware('auth');

Route::get('/{hash}', 'LinksController@process');
