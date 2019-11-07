<?php

Auth::routes();

Route::get('/', 'LinksController@create');
Route::post('/links', 'LinksController@store');
Route::get('/links/{link}', 'LinksController@show');
Route::get('/dashboard', 'DashboardController@index')->middleware('auth');

Route::get('/admin/links', 'AdminController@links')->middleware('admin');
Route::get('/admin/users', 'AdminController@users')->middleware('admin');

Route::get('/{hash}', 'LinksController@process');
