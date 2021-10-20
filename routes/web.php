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
Route::get('/crud', 'SimpleCRUDController@index')->name('crud');
Route::post('/crud/manage-data', 'SimpleCRUDController@manageFormData');

Route::get('/regex', 'SimpleRegexController@index')->name('regex');
Route::post('/regex-input', 'SimpleRegexController@checkString');

Route::get('/factorial', 'SimpleFactorialController@index')->name('factorial');
Route::post('/factorial-input', 'SimpleFactorialController@calculate');

Route::group(['middleware' => 'role:admin'], function() {
    Route::get('/admin', function() {
        return 'Welcome Admin';
    });
});
