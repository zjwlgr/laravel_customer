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
    return redirect(route('index'));
});


// Customer.Route
Route::match(['get', 'post'], '/login.jay', 'Customer\LoginController@login');
Route::get('/loginout.jay', 'Customer\LoginController@loginout');

Route::get('/index.jay', 'Customer\IndexController@index')->name('index');

Route::match(['get', 'post'], '/addManager.jay', 'Customer\ManagerController@addManager')->name('addManager');
Route::get('/listManager.jay', 'Customer\ManagerController@listManager')->name('listManager');

Route::match(['get', 'post'], '/addInfo.jay', 'Customer\InfomationController@addInfo')->name('addInfo');
Route::get('/listInfo.jay', 'Customer\InfomationController@listInfo')->name('listInfo');

Route::match(['get', 'post'], '/upManager-{id}.jay', 'Customer\ManagerController@upManager');

Route::get('/delManager-{id}.jay', 'Customer\ManagerController@delManager');