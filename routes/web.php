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
    return view('welcome');
});


Route::get('/engines', 'EnginesController@get_engines');

Route::get('/get_locations', 'LocationsController@get_locations');


Route::resource('locations', 'LocationsController');

Route::get('/search', 'LiveController@search');
Route::get('/get_results', 'LiveController@get_results');
Route::resource('results', 'LiveController');

Route::post('/search/engine', 'LiveController@search_engine')->name('search.engine');
Route::post('/search/language', 'LiveController@search_language')->name('search.language');
Route::post('/search/location', 'LiveController@search_location')->name('search.location');
//Route::post('/autocomplete/fetch', 'AutocompleteController@fetch')->name('autocomplete.fetch');


Route::get ('/all_results',['uses'=>'LiveController@all_results'])->name('C:\xampp\htdocs\myproject\resources\views\live\all_results.blade.php');
