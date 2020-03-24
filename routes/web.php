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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add-image', 'HomeController@addImage')->name('add-image');
Route::post('/submit-image', 'HomeController@submitData')->name('submit-image');
Route::post('/data-delete','HomeController@deleteData')->name('data-delete');
Route::get('/search-image','HomeController@searchImage')->name('search-image');

Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function (){
    Route::get('login','AdminAuthController@getLogin')->name('login');
    Route::post('login','AdminAuthController@postLogin')->name('login-submit');
    Route::post('logout','AdminAuthController@postLogout')->name('logout');
    Route::get('dashboard','AdminController@index')->name('dashboard');
});