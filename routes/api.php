<?php

/**
 * Todo CRUD routes
 */

//get all the todos
Route::get('/todos','TodosController@index');

//store a todo in the database.
Route::post('/todos','TodosController@store');

//get a specified todo.
Route::get('/todos/{id}','TodosController@show');

//update a specified todo.
Route::put('/todos/{id}','TodosController@update');

//delete a specified todo.
Route::delete('/todos/{id}','TodosController@destroy');

//login users
Route::post('/login','Auth\LoginController@authenticate');

//register users
Route::post('/register','Auth\RegisterController@register');

//logout users
Route::post('/logout','Auth\LoginController@logout')->middleware('jwt.verify');

//get authenticated user
Route::get('/user','Auth\LoginController@getAuthenticatedUser')->middleware('jwt.verify');
