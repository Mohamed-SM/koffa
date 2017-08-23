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
    return view('intro.welcome');
});

Route::get('/contact', function () {
    return view('intro.contact');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('shops', 'ShopController');

Route::resource('categories', 'CategorieController');

Route::resource('services', 'ServiceController');

Route::put('/delever/{service}','ServiceController@delever');

Route::resource('clinics', 'ClinicController');

Route::resource('clients', 'ClientController');

Route::resource('students', 'StudentController');

Route::resource('schools', 'SchoolController');