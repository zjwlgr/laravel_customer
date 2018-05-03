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

Route::get('/ajaxPhone.jay', 'Customer\InfomationController@ajaxPhone');

Route::get('/ajaxDetail.jay', 'Customer\InfomationController@ajaxDetail');

Route::match(['get', 'post'],'/upInfo-{id}.jay', 'Customer\InfomationController@upInfo');

Route::get('/delInfo-{id}.jay', 'Customer\InfomationController@delInfo');

Route::match(['get', 'post'], '/upManager-{id}.jay', 'Customer\ManagerController@upManager');

Route::get('/delManager-{id}.jay', 'Customer\ManagerController@delManager');


// 新加功能路由
Route::match(['get', 'post'], '/addResume.jay', 'Customer\ResumeController@addResume')->name('addResume');
Route::get('/ajaxPhoneResume.jay', 'Customer\ResumeController@ajaxPhone');
Route::get('/listResume.jay', 'Customer\ResumeController@listResume')->name('listResume');
Route::match(['get', 'post'], '/upResume-{id}.jay', 'Customer\ResumeController@upResume');
Route::get('/delResume-{id}.jay', 'Customer\ResumeController@delResume');
Route::get('/ajaxDetail_resume.jay', 'Customer\ResumeController@ajaxDetail');


