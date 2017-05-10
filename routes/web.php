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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/inbox','InboxController',['only'=>['index','show','destroy']]);

Route::resource('/sent','SentController',['only'=>['index','create','show','destroy']]);

Route::post('/sent/create','SentController@store');

Route::get('/login',"LoginController@loginPage");

Route::post('/login',"LoginController@login");

Route::get('/logout',"LoginController@logout");