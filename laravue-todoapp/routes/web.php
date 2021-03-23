<?php


/**
 * Catch all routes and map it to our index method
 * which will simple return home view no matter what
 * the route.
 */
Route::get('/{any}', 'SpaController@index')->where('any','.*');