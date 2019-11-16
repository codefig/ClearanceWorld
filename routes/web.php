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
Route::get('/admin/login', 'LoginController@showAdminLoginForm')->name('admin.login');
Route::post('/admin/login', 'LoginController@adminLogin')->name('admin.login.post');
Route::get('/admin/dashboard', function () {
    return view('admin.profile');
});

Route::get('/user/dashboard', function () {
    return view('user.dashboard');
})->name('user.dashboard');

Route::get('/user/logout', 'LoggedUserController@logout')->name('user.logout');
