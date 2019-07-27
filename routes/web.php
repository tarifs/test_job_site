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
Route::post('/profile/uploadresume', 'ApplicantController@uploadresume');
Route::get('/profile/{name}', 'ApplicantController@profile');
Route::get('/my-jobs', 'ApplicantController@myJobs');

// Skill Controller
Route::post('/profile/skills/store', 'SkillController@storeSkill');
Route::post('/profile/skills/edit', 'SkillController@editSkill');

// Apply Controller
Route::get('/job/application/{id}', 'ApplyController@show');
Route::post('/job/application/{id}/store', 'ApplyController@store');
Route::get('/applicant/profile/{id}', 'ApplyController@view');

// Company Controller
Route::get('/dashboard', 'CompanyController@dashboard');
Route::get('/shortlist/{id}', 'CompanyController@shortlist');
Route::get('/proposal/{id}/{user_id}', 'CompanyController@apply');
Route::get('/proposal/{id}/{user}/approve', 'CompanyController@approved');
Route::get('/proposal/{id}/{user}/reject', 'CompanyController@reject');

// Admin Controller
Route::get('/panel/applicant', 'AdminController@showApplicants');
Route::post('/panel/users/ban', 'AdminController@banApplicants');
Route::post('/panel/applicant/unban', 'AdminController@unbanApplicants');
Route::get('/panel/company', 'AdminController@showCompanies');
Route::post('/panel/company/unban', 'AdminController@unbanCompanies');
Route::get('/panel/jobs', 'AdminController@showJobs');
Route::get('/panel/jobs/delete/{id}', 'AdminController@deleteJob');
