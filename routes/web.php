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

Route::get('/', 'HomeController@index')->name('home.index');
Route::post('/', 'HomeController@store')->name('home.store');
Route::post('/reset', 'HomeController@reset')->name('home.reset');

Route::get('/advanced', 'AdvancedController@index')->name('advanced.index');
Route::post('/advanced', 'AdvancedController@store')->name('advanced.store');

Route::get('/about', function () {
    return view('about');
})->name('about.index');
