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

// use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('index');
});



Route::group(['prefix' => 'user'], function () {

    Route::get('/login', 'Auth\LoginController@showUserLoginForm')->name('user.login');
    Route::post('/login', 'Auth\LoginController@userLogin')->name('user.login.post');
    Route::get('/logout', 'LoggedUserController@logout')->name('user.logout');
    Route::get('/dashboard', 'LoggedUserController@showDashboard')->name('user.dashboard');
});

Route::group(['prefix' => 'admin'], function () {

    Route::get('/login', 'Auth\LoginController@showAdminLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\LoginController@adminLogin')->name('admin.login.post');
    Route::get('/logout', 'LoggedAdminController@logout')->name('admin.logout');
    Route::get('/dashboard', 'LoggedAdminController@showDashboard')->name('admin.dashboard');
    Route::get('/addDepartment', 'LoggedAdminController@showAddDepartment')->name('admin.addDepartment');
    Route::post('/addDepartment', 'LoggedAdminController@postAddDepartment')->name('admin.addDepartment.post');
    Route::get('/addStudent', 'LoggedAdminController@showAddStudent')->name('admin.addStudent');
    Route::post('/addStudent', 'LoggedAdminController@postAddStudent')->name('admin.addStudent.post');
});
