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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/addregion', 'RegionController@regionForm')->name('addregion');
Route::post('/createregion', 'RegionController@createRegion')->name('createregion');
Route::get('/index', 'RegionController@index')->name('listRegion');
Route::get('/regionedit/{id}', 'RegionController@editForm')->name('editRegion');
Route::put('/updateregion/{id}', 'RegionController@updateRegion')->name('updateregion');

Route::get('/addcity', 'CityController@cityForm')->name('addcity');
Route::post('/createcity', 'CityController@createCity')->name('createcity');
Route::get('/listcity', 'CityController@index')->name('listcity');
Route::get('/cityedit/{id}', 'CityController@editForm')->name('editCity');
Route::put('/updatecity/{id}', 'CityController@updateCity')->name('updatecity');

Route::get('/addguesthouse', 'GuesthouseController@newForm')->name('addguesthouse');
Route::post('/createguesthouse', 'GuesthouseController@create')->name('createguesthouse');
Route::get('/listguesthouse', 'GuesthouseController@index')->name('listguesthouse');
Route::get('/guesthouseeditedit/{id}', 'GuesthouseController@editForm')->name('guesthouseeditedit');
Route::put('/updateguesthouse/{id}', 'GuesthouseController@updateGuesthouse')->name('updateguesthouse');
