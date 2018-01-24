<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'CourseController@retrieveData');

Route::post('/save', 'CourseController@saveCourse');

Route::get('/saved_courses', 'CourseController@savedCourses');
