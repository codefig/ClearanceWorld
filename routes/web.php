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

Route::get('/login', 'Auth\LoginController@showUserLoginForm')->name('user.login');
Route::post('/login', 'Auth\LoginController@userLogin')->name('user.login.post');
Route::get('/admin/login', 'Auth\LoginController@showAdminLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\LoginController@adminLogin')->name('admin.login.post');
Route::get('/admin/dashboard', 'LoggedAdminController@showDashboard')->name('admin.dashboard');

Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard');

Route::get('/user/logout', 'LoggedUserController@logout')->name('user.logout');
Route::get('/admin/logout', 'LoggedAdminController@logout')->name('admin.logout');
