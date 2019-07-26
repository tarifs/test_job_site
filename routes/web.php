<?php


Auth::routes();

// Page Controller
Route::get('/','PageController@index');

// Job Controller
Route::resource('/jobs','JobController');
