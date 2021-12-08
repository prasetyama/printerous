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

});
