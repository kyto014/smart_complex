<?php

use Illuminate\Http\Request;
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

Route::get('/people', 'App\Http\Controllers\RFID\v1\PersonController@getAll');
Route::get('/people/{person_id}','App\Http\Controllers\RFID\v1\PersonController@get');
Route::post('/people', 'App\Http\Controllers\RFID\v1\PersonController@create');
Route::post('people/{person_id}', 'App\Http\Controllers\RFID\v1\PersonController@update');
Route::delete('people/{person_id}','App\Http\Controllers\RFID\v1\PersonController@delete');

Route::get('/people/keys', 'App\Http\Controllers\RFID\v1\KeyController@getAll');
Route::get('/people/keys/{key_id}','App\Http\Controllers\RFID\v1\KeyController@get');
Route::post('/people/keys', 'App\Http\Controllers\RFID\v1\KeyController@create');
Route::post('people/keys/{key_id}', 'App\Http\Controllers\RFID\v1\KeyController@update');
Route::delete('people/keys/{key_id}','App\Http\Controllers\RFID\v1\KeyController@delete');

Route::get('/profiles', 'App\Http\Controllers\RFID\v1\ProfileController@getAll');
Route::get('/profiles/{profile_id}','App\Http\Controllers\RFID\v1\ProfileController@get');
Route::post('/profiles', 'App\Http\Controllers\RFID\v1\ProfileController@create');
Route::post('/profiles/{profile_id}', 'App\Http\Controllers\RFID\v1\ProfileController@update');
Route::delete('/profiles/{profile_id}','App\Http\Controllers\RFID\v1\ProfileController@delete');

Route::get('/profiles/accesses', 'App\Http\Controllers\RFID\v1\AccessController@getAll');
Route::get('/profiles/accesses/{access_id}','App\Http\Controllers\RFID\v1\AccessController@get');
Route::post('/profiles/accesses', 'App\Http\Controllers\RFID\v1\AccessController@create');
Route::post('/profiles/accesses/{access_id}', 'App\Http\Controllers\RFID\v1\AccessController@update');
Route::delete('/profiles/accesses/{access_id}','App\Http\Controllers\RFID\v1\AccessController@delete');