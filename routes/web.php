<?php


Auth::routes();

// Page Controller
Route::get('/','PageController@index');

// Job Controller
Route::resource('/jobs','JobController');

// Applicant Controller
Route::get('/userdashboard', 'ApplicantController@index');
Route::post('/profile/store', 'ApplicantController@storeProfile');
Route::post('/profile/edit', 'ApplicantController@updateProfile');
Route::post('/profile/uploadphoto', 'ApplicantController@uploadPhoto');
Route::post('/profile/updatephoto', 'ApplicantController@updatePhoto');
Route::get('/profile/{name}', 'ApplicantController@profile');
Route::get('/my-jobs', 'ApplicantController@myJobs');
