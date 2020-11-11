<?php

use Illuminate\Support\Facades\Route;

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
//display image uploading form
Route::get('ajax-image-upload','AjaxImageController@index');

//insert files or images into mysql database table laravel
Route::post('ajax-image-upload','AjaxImageController@store');