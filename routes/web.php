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
Route::get('/template', 'TemplateController@index')->name('template');
Route::get('template/get-form/{name?}', 'TemplateFormController@create')->name('template.getform');

Route::group(['middleware' => 'role:admin','namespace'=>'Admin'], function() {
    Route::post('user/get', 'User\UserTableController')->name('user.get');
    Route::post('role/get', 'Role\RoleTableController')->name('role.get');
    Route::post('permission/get', 'Permission\PermissionTableController')->name('permission.get');
    
    Route::resource('user', 'User\UserController');
    /*
    * Specific User
    */
    Route::group(['prefix' => 'user/{user}'], function () {
        // Password
        Route::get('password/change', 'User\UserPasswordController@edit')->name('user.change-password');
        Route::patch('password/change', 'User\UserPasswordController@update')->name('user.change-password');
    });

    Route::resource('role', 'Role\RoleController');
    Route::resource('permission', 'Permission\PermissionController');

    Route::resource('menu', 'Menu\MenuController');
    Route::get('menu/get-form/{name?}', 'Menu\MenuFormController@create')->name('menu.getform');
});
