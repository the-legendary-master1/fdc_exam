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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/welcome-page', 'HomeController@welcomePage')->name('welcome-page');
Route::post('/add-contact', 'HomeController@addContact')->name('add-contact');
Route::post('/edit-contact', 'HomeController@editContact')->name('edit-contact');
Route::post('/delete-contact/{id}', 'HomeController@deleteContact')->name('delete-contact');
Route::get('/search', 'HomeController@search');