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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {

	Route::get('/organization', 'OrganizationController@index')->name('organization_list');
	Route::get('/organization/add', 'OrganizationController@add')->name('organization_add');
    Route::post('/organization/submit', 'OrganizationController@submit_add')->name('organization_process');
    Route::get('/organization/edit/{id}', 'OrganizationController@edit')->name('organization_edit');
    Route::get('/organization/detail/{id}', 'OrganizationController@detail')->name('organization_detail');
    Route::post('/organization/update', 'OrganizationController@submit_edit')->name('organization_update');
    Route::get('/organization/delete/{id}', 'OrganizationController@delete')->name('organization_delete');


    Route::group(['middleware' => ['admin']], function () {
        Route::get('/user', 'UserController@index')->name('user_index');
        Route::get('/user-create', 'UserController@create')->name('user_create');
        Route::post('/user-create', 'UserController@create_proses')->name('user_proses');
        Route::get('/user-update/{id}', 'UserController@update')->name('user_update');
        Route::post('/user-update', 'UserController@update_proses')->name('update_proses_user');
        Route::get('/user-details', 'UserController@details')->name('user_details');
        Route::get('/user-destroy/{id}', 'UserController@destroy')->name('user_destroy');
    });

});
