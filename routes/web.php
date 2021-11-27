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

Route::prefix('clients')->group(function () {

    Route::get('','ClientController@index')->name('client.index');
    Route::get('create', 'ClientController@create')->name('client.create');
    Route::post('store', 'ClientController@store')->name('client.store');
    Route::post('storeAjax', 'ClientController@storeAjax')->name('client.storeAjax');
    Route::get('edit/{client}', 'ClientController@edit')->name('client.edit');
    Route::get('editAjax/{client}', 'ClientController@editAjax')->name('client.editAjax');
    Route::post('update/{client}', 'ClientController@update')->name('client.update');

    Route::post('updateAjax/{client}', 'ClientController@updateAjax')->name('client.updateAjax');

    Route::post('delete/{client}', 'ClientController@destroy' )->name('client.destroy');
    Route::post('deleteAjax/{client}', 'ClientController@destroyAjax' )->name('client.destroyAjax');
    Route::get('show/{client}', 'ClientController@show')->name('client.show');
    Route::get('showAjax/{client}', 'ClientController@showAjax')->name('client.showAjax');


});

Route::prefix('companies')->group(function () {

    Route::get('','CompanyController@index')->name('company.index');
    Route::get('create', 'CompanyController@create')->name('company.create');
    Route::post('store', 'CompanyController@store')->name('company.store');
    Route::get('edit/{company}', 'CompanyController@edit')->name('company.edit');
    Route::post('update/{company}', 'CompanyController@update')->name('company.update');
    Route::post('delete/{company}', 'CompanyController@destroy' )->name('company.destroy');
    Route::get('show/{company}', 'CompanyController@show')->name('company.show');
    Route::post('destroySelected', 'CompanyController@destroySelected')->name('company.destroySelected');

});
