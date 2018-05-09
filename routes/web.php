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

Route::get('/', 'App\Http\Controllers\Controller@welcomePage');

Route::get('/people', 'App\Http\Controllers\RFID\v1\PersonController@getAll');
Route::get('/people/{person_id}','App\Http\Controllers\RFID\v1\PersonController@get');
Route::post('/people', 'App\Http\Controllers\RFID\v1\PersonController@create');
Route::get('/people-create', 'App\Http\Controllers\RFID\v1\PersonController@createPerson');
Route::post('people/{person_id}', 'App\Http\Controllers\RFID\v1\PersonController@update');
Route::get('people-delete/{person_id}','App\Http\Controllers\RFID\v1\PersonController@delete');

Route::get('/keys', 'App\Http\Controllers\RFID\v1\KeyController@getAll');
Route::get('/keys/{key_id}','App\Http\Controllers\RFID\v1\KeyController@get');
Route::get('/key-create', 'App\Http\Controllers\RFID\v1\KeyController@createKey');
Route::post('/keys', 'App\Http\Controllers\RFID\v1\KeyController@create');
Route::post('/keys/{key_id}', 'App\Http\Controllers\RFID\v1\KeyController@update');
Route::get('/keys-delete/{key_id}','App\Http\Controllers\RFID\v1\KeyController@delete');

Route::get('/profiles', 'App\Http\Controllers\RFID\v1\ProfileController@getAll');
Route::get('/profiles/{profile_id}','App\Http\Controllers\RFID\v1\ProfileController@get');
Route::post('/profiles', 'App\Http\Controllers\RFID\v1\ProfileController@create');
Route::get('/profile-create', 'App\Http\Controllers\RFID\v1\ProfileController@createProfile');
Route::post('/profiles/{profile_id}', 'App\Http\Controllers\RFID\v1\ProfileController@update');
Route::get('/profiles-delete/{profile_id}','App\Http\Controllers\RFID\v1\ProfileController@delete');

Route::get('/accesses', 'App\Http\Controllers\RFID\v1\AccessController@getAll');
Route::get('/accesses/{access_id}','App\Http\Controllers\RFID\v1\AccessController@get');
Route::post('/access', 'App\Http\Controllers\RFID\v1\AccessController@create');
Route::get('/access-create','App\Http\Controllers\RFID\v1\AccessController@createAccess');
Route::post('/accesses/{access_id}', 'App\Http\Controllers\RFID\v1\AccessController@update');
Route::get('/accesses-delete/{access_id}','App\Http\Controllers\RFID\v1\AccessController@delete');

Route::get('/secondFactors', 'App\Http\Controllers\RFID\v1\SecondFactorController@getAll');
Route::get('/addSecondFactor', 'App\Http\Controllers\RFID\v1\SecondFactorController@getAllPeople');
Route::post('/secondFactors', 'App\Http\Controllers\RFID\v1\SecondFactorController@createSecondFactor');
Route::get('/secondFactors-delete/{second_factor_id}','App\Http\Controllers\RFID\v1\SecondFactorController@delete');