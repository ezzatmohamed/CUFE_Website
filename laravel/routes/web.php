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

Route::get('/','logController@logpage');
Route::post('/','logController@login');
Route::get('/signup','logController@signpage');
Route::post('/signup','logController@signup');

Route::get('/home','HomeController@homepage');
Route::get('/logout','logController@logout');
Route::post('/home','HomeController@posting');

Route::get('/profile',function(){
    return view('profile');
});


Route::get('/addproject','ProjectController@addpage');
Route::post('/addproject','ProjectController@addproject');
Route::get('/projects/{id?}','ProjectController@showprojects');
Route::get('/project/{id}','ProjectController@projectdetails');


Route::get('/editprofile','ProfileController@editpage');
Route::post('/editprofile','ProfileController@editprofile');

Route::get('/settings','ProfileController@settingspage');
Route::post('/changepwd','ProfileController@changepwd');
Route::post('/changepic','ProfileController@changepic');
