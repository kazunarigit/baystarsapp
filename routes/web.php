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


Route::get('/butterinfo', 'ButterController@show');
Route::get('/pitcherinfo', 'PitcherController@show'); # 追記
    

Route::get('/', 'TopController@index');

