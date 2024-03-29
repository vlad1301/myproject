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

Route::get('/', 'LiveController@search');




Route::get('/get_engines', 'EnginesController@get_engines');

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

Route::get('/tasker' , function() {
    Artisan::call('tasker:cron');
});

Route::get('/retriever' , function() {
    Artisan::call('retriever:cron');
});

Route::get('/set_project', 'ProjectsController@set_project');
Route::resource('projects', 'ProjectsController');

Route::get('/view_projects_results', 'ProjectsController@view_projects_results');
