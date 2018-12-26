<?php

/**
 * Todo CRUD routes
 */
Route::get('/todos','TodosController@index');
Route::post('/todos','TodosController@store');
Route::get('/todos/{id}','TodosController@show');
Route::put('/todos/{id}','TodosController@update');
Route::delete('/todos/{id}','TodosController@destroy');